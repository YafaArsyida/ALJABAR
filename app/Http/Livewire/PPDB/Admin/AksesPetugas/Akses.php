<?php

namespace App\Http\Livewire\PPDB\Admin\AksesPetugas;

use App\Models\Jenjang;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Akses extends Component
{
    public $userId;
    public $nama = '';
    public $jenjangIds = [];

    protected $listeners = [
        'editAksesPetugas' => 'loadAkses',
    ];

    public function loadAkses($userId): void
    {
        $this->authorizeManagement();
        $user = User::query()
            ->whereIn('peran', ['SUPERADMIN', 'PETUGAS_PPDB'])
            ->findOrFail($userId);

        $this->resetValidation();
        $this->userId = $user->ms_pengguna_id;
        $this->nama = $user->nama;
        $this->jenjangIds = $user->ms_jenjang()
            ->pluck('ms_jenjang.ms_jenjang_id')
            ->map(fn ($id) => (string) $id)
            ->all();

        $this->dispatchBrowserEvent('show-modal', [
            'modalId' => 'ModalAksesPetugas',
        ]);
    }

    public function save(): void
    {
        $this->authorizeManagement();
        $this->validate([
            'userId' => 'required|integer',
            'jenjangIds' => 'required|array|min:1',
            'jenjangIds.*' => 'required|integer|exists:ms_jenjang,ms_jenjang_id',
        ], [
            'jenjangIds.required' => 'Pilih minimal satu jenjang.',
            'jenjangIds.min' => 'Pilih minimal satu jenjang.',
            'jenjangIds.*.exists' => 'Jenjang yang dipilih tidak valid.',
        ]);

        $activeIds = Jenjang::query()
            ->where('status', 'Aktif')
            ->whereIn('ms_jenjang_id', $this->jenjangIds)
            ->pluck('ms_jenjang_id')
            ->map(fn ($id) => (string) $id)
            ->all();

        if (count($activeIds) !== count($this->jenjangIds)) {
            $this->addError('jenjangIds', 'Pilih hanya jenjang yang masih aktif.');

            return;
        }

        $user = User::query()
            ->whereIn('peran', ['SUPERADMIN', 'PETUGAS_PPDB'])
            ->findOrFail($this->userId);

        DB::transaction(function () use ($user, $activeIds) {
            $user->ms_jenjang()->sync($activeIds);
        });

        $this->dispatchBrowserEvent('hide-modal', [
            'modalId' => 'ModalAksesPetugas',
        ]);
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Akses jenjang petugas berhasil diperbarui.',
        ]);
        $this->emit('refreshAksesPetugas');
        $this->reset(['userId', 'nama', 'jenjangIds']);
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

        return view('livewire.p-p-d-b.admin.akses-petugas.akses', [
            'daftarJenjang' => Jenjang::query()
                ->where('status', 'Aktif')
                ->orderBy('urutan')
                ->get(),
        ]);
    }
}
