<?php

namespace App\Http\Livewire\PPDB\Admin\AksesPetugas;

use App\Models\User;
use Livewire\Component;

class Detail extends Component
{
    public $petugas;

    protected $listeners = [
        'showDetailPetugas' => 'loadPetugas',
    ];

    public function loadPetugas($userId): void
    {
        $this->authorizeManagement();
        $this->petugas = User::query()
            ->whereIn('peran', ['SUPERADMIN', 'PETUGAS_PPDB'])
            ->with('ms_jenjang')
            ->findOrFail($userId);

        $this->dispatchBrowserEvent('show-modal', [
            'modalId' => 'ModalDetailPetugasSPMB',
        ]);
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

        return view('livewire.p-p-d-b.admin.akses-petugas.detail');
    }
}
