<?php

namespace App\Http\Livewire\PPDB\Admin\AksesPetugas;

use App\Models\Jenjang;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{
    public $nama = '';
    public $email = '';
    public $password = '';
    public $jenjangIds = [];

    protected $listeners = [
        'showCreatePetugas' => 'openModal',
    ];

    public function openModal(): void
    {
        $this->authorizeManagement();
        $this->resetValidation();
        $this->reset(['nama', 'email', 'password', 'jenjangIds']);
        $this->dispatchBrowserEvent('show-modal', [
            'modalId' => 'ModalAddPetugasSPMB',
        ]);
    }

    public function save(): void
    {
        $this->authorizeManagement();
        $validated = $this->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:ms_pengguna,email',
            'password' => 'required|string|min:6',
            'jenjangIds' => 'required|array|min:1',
            'jenjangIds.*' => 'required|integer|exists:ms_jenjang,ms_jenjang_id',
        ], [
            'nama.required' => 'Nama petugas wajib diisi.',
            'email.required' => 'Email atau username wajib diisi.',
            'email.unique' => 'Email atau username sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'jenjangIds.required' => 'Pilih minimal satu jenjang.',
            'jenjangIds.min' => 'Pilih minimal satu jenjang.',
            'jenjangIds.*.exists' => 'Jenjang yang dipilih tidak valid.',
        ]);

        $jenjangIds = $this->getActiveJenjangIds($validated['jenjangIds']);
        if ($jenjangIds === null) {
            return;
        }

        DB::transaction(function () use ($validated, $jenjangIds) {
            $user = User::create([
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'peran' => 'PETUGAS_PPDB',
            ]);
            $user->ms_jenjang()->sync($jenjangIds);
        });

        $this->dispatchBrowserEvent('hide-modal', [
            'modalId' => 'ModalAddPetugasSPMB',
        ]);
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Akun petugas SPMB berhasil ditambahkan.',
        ]);
        $this->emit('refreshAksesPetugas');
        $this->reset(['nama', 'email', 'password', 'jenjangIds']);
    }

    private function getActiveJenjangIds(array $ids): ?array
    {
        $activeIds = Jenjang::query()
            ->where('status', 'Aktif')
            ->whereIn('ms_jenjang_id', $ids)
            ->pluck('ms_jenjang_id')
            ->map(fn ($id) => (string) $id)
            ->all();

        if (count($activeIds) !== count($ids)) {
            $this->addError('jenjangIds', 'Pilih hanya jenjang yang masih aktif.');

            return null;
        }

        return $activeIds;
    }

    private function authorizeManagement(): void
    {
        $role = strtoupper(trim(auth()->user()?->peran ?? ''));
        abort_unless(
            in_array($role, ['SUPERADMIN', 'ADMIN', 'PETUGAS_PPDB'], true),
            403
        );
    }

    public function render()
    {
        $this->authorizeManagement();

        return view('livewire.p-p-d-b.admin.akses-petugas.create', [
            'daftarJenjang' => Jenjang::query()
                ->where('status', 'Aktif')
                ->orderBy('urutan')
                ->get(),
        ]);
    }
}
