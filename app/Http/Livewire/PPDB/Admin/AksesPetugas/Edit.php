<?php

namespace App\Http\Livewire\PPDB\Admin\AksesPetugas;

use App\Models\Jenjang;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public $userId;
    public $nama = '';
    public $email = '';
    public $password = '';
    public $jenjangIds = [];

    protected $listeners = [
        'editPetugas' => 'loadPetugas',
    ];

    public function loadPetugas($userId): void
    {
        $this->authorizeManagement();
        $user = $this->petugasQuery()->findOrFail($userId);

        $this->resetValidation();
        $this->userId = $user->ms_pengguna_id;
        $this->nama = $user->nama;
        $this->email = $user->email;
        $this->password = '';
        $this->jenjangIds = $user->ms_jenjang()
            ->pluck('ms_jenjang.ms_jenjang_id')
            ->map(fn ($id) => (string) $id)
            ->all();

        $this->dispatchBrowserEvent('show-modal', [
            'modalId' => 'ModalEditPetugasSPMB',
        ]);
    }

    public function update(): void
    {
        $this->authorizeManagement();
        $validated = $this->validate([
            'userId' => 'required|integer',
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'max:255',
                Rule::unique('ms_pengguna', 'email')
                    ->ignore($this->userId, 'ms_pengguna_id'),
            ],
            'password' => 'nullable|string|min:6',
            'jenjangIds' => 'required|array|min:1',
            'jenjangIds.*' => 'required|integer|exists:ms_jenjang,ms_jenjang_id',
        ], [
            'nama.required' => 'Nama petugas wajib diisi.',
            'email.required' => 'Email atau username wajib diisi.',
            'jenjangIds.required' => 'Pilih minimal satu jenjang.',
            'jenjangIds.min' => 'Pilih minimal satu jenjang.',
            'jenjangIds.*.exists' => 'Jenjang yang dipilih tidak valid.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $jenjangIds = $this->getActiveJenjangIds($validated['jenjangIds']);
        if ($jenjangIds === null) {
            return;
        }

        $user = $this->petugasQuery()->findOrFail($this->userId);

        DB::transaction(function () use ($user, $validated, $jenjangIds) {
            $data = [
                'nama' => $validated['nama'],
                'email' => $validated['email'],
            ];
            if (filled($validated['password'])) {
                $data['password'] = Hash::make($validated['password']);
            }

            $user->update($data);
            $user->ms_jenjang()->sync($jenjangIds);
        });

        $this->dispatchBrowserEvent('hide-modal', [
            'modalId' => 'ModalEditPetugasSPMB',
        ]);
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Data petugas SPMB berhasil diperbarui.',
        ]);
        $this->emit('refreshAksesPetugas');
        $this->reset(['userId', 'nama', 'email', 'password', 'jenjangIds']);
    }

    private function petugasQuery()
    {
        return User::query()->where('peran', 'PETUGAS_PPDB');
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

        return view('livewire.p-p-d-b.admin.akses-petugas.edit', [
            'daftarJenjang' => Jenjang::query()
                ->where('status', 'Aktif')
                ->orderBy('urutan')
                ->get(),
        ]);
    }
}
