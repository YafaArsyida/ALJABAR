<?php

namespace App\Http\Livewire\PPDB\Admin\AksesPetugas;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $search = '';

    protected $listeners = [
        'refreshAksesPetugas' => '$refresh',
    ];

    public function render()
    {
        $role = strtoupper(trim(auth()->user()?->peran ?? ''));
        abort_unless(
            in_array($role, ['SUPERADMIN', 'ADMIN', 'PETUGAS_PPDB'], true),
            403
        );

        $pengguna = User::query()
            ->whereIn('peran', ['SUPERADMIN', 'PETUGAS_PPDB'])
            ->with('ms_jenjang')
            ->when(trim($this->search) !== '', function ($query) {
                $search = trim($this->search);

                $query->where(function ($query) use ($search) {
                    $query->where('nama', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('peran', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('peran')
            ->orderBy('nama')
            ->get();

        return view('livewire.p-p-d-b.admin.akses-petugas.index', [
            'pengguna' => $pengguna,
        ]);
    }
}
