<?php

namespace App\Http\Livewire\PPDB\Admin\Dashboard;

use Livewire\Component;
use App\Models\PPDBPeriode;
use App\Models\PPDBPendaftaran;
use Illuminate\Support\Facades\Auth;

class AntreanPekerjaan extends Component
{
    public $selectedJenjang = null;
    public $selectedPeriode = null;

    protected $listeners = [
        'dashboardParametersUpdated' => 'updateParameters',
    ];

    public function updateParameters($jenjangId = null, $periodeId = null)
    {
        $this->selectedJenjang = $jenjangId;
        $this->selectedPeriode = $periodeId;
    }

    public function render()
    {
        $periode = null;
        $menungguVerifikasi = 0;
        $perluPerbaikan = 0;

        if ($this->selectedJenjang && $this->selectedPeriode) {
            $periode = PPDBPeriode::query()
                ->forAuthorizedJenjang(Auth::id())
                ->whereKey($this->selectedPeriode)
                ->where('ms_jenjang_id', $this->selectedJenjang)
                ->first();

            if ($periode) {
                $query = PPDBPendaftaran::query()
                    ->where('ppdb_periode_id', $periode->ppdb_periode_id);

                $menungguVerifikasi = (clone $query)
                    ->whereIn('status', [
                        'pengecekan',
                        // 'menunggu_verifikasi',
                    ])
                    ->count();

                $perluPerbaikan = (clone $query)
                    ->where('status', 'perbaikan')
                    ->count();
            }
        }
        return view('livewire.p-p-d-b.admin.dashboard.antrean-pekerjaan',
            compact(
                'periode',
                'menungguVerifikasi',
                'perluPerbaikan'
            )
        );
    }
}
