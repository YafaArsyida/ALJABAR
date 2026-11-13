<?php

namespace App\Http\Livewire\PPDB\Admin\AksesPetugas;

use App\Models\PPDBBerkas;
use App\Models\PPDBPendaftaran;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class Delete extends Component
{
    public $userId;
    public $nama = '';

    protected $listeners = [
        'confirmDeletePetugas' => 'loadPetugas',
    ];

    public function loadPetugas($userId): void
    {
        $this->authorizeManagement();
        $user = $this->petugasQuery()->findOrFail($userId);
        $this->userId = $user->ms_pengguna_id;
        $this->nama = $user->nama;
    }

    public function delete(): void
    {
        $this->authorizeManagement();
        $user = $this->petugasQuery()->findOrFail($this->userId);

        if ($this->hasPpdbHistory($user->ms_pengguna_id)) {
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Petugas tidak dapat dihapus karena sudah memiliki riwayat pendataan atau verifikasi.',
            ]);

            return;
        }

        try {
            DB::transaction(function () use ($user) {
                $user->ms_jenjang()->detach();
                $user->delete();
            });
        } catch (\Throwable $exception) {
            report($exception);
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Akun petugas gagal dihapus karena masih digunakan oleh data lain.',
            ]);

            return;
        }

        $this->dispatchBrowserEvent('hide-modal', [
            'modalId' => 'ModalDeletePetugasSPMB',
        ]);
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Akun petugas SPMB berhasil dihapus.',
        ]);
        $this->emit('refreshAksesPetugas');
        $this->reset(['userId', 'nama']);
    }

    private function hasPpdbHistory(int $userId): bool
    {
        $hasPendaftaranHistory = false;
        $hasCreatedBy = Schema::hasColumn('ppdb_pendaftaran', 'created_by');
        $hasSubmittedBy = Schema::hasColumn('ppdb_pendaftaran', 'submitted_by');

        if ($hasCreatedBy || $hasSubmittedBy) {
            $hasPendaftaranHistory = PPDBPendaftaran::query()
                ->where(function ($query) use (
                    $userId,
                    $hasCreatedBy,
                    $hasSubmittedBy
                ) {
                    if ($hasCreatedBy) {
                        $query->where('created_by', $userId);
                    }
                    if ($hasSubmittedBy) {
                        $query->{$hasCreatedBy ? 'orWhere' : 'where'}(
                            'submitted_by',
                            $userId
                        );
                    }
                })
                ->exists();
        }

        $hasVerifiedFiles = Schema::hasColumn('ppdb_berkas', 'verified_by')
            && PPDBBerkas::query()
                ->where('verified_by', $userId)
                ->exists();

        return $hasPendaftaranHistory || $hasVerifiedFiles;
    }

    private function petugasQuery()
    {
        return User::query()->where('peran', 'PETUGAS_PPDB');
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

        return view('livewire.p-p-d-b.admin.akses-petugas.delete');
    }
}
