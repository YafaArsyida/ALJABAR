<?php

namespace App\Http\Livewire\PPDB\Admin\Dashboard;

use Livewire\Component;
use App\Models\PPDBPeriode;
use App\Models\PPDBJalur;
use Illuminate\Support\Facades\Auth;

class InformasiPeriode extends Component
{
    public $selectedJenjang = null;
    public $selectedPeriode = null;
    public $dashboardParametersReceived = false;

    protected $listeners = [
        'parameterUpdated' => 'updateParameters',
        'dashboardParametersUpdated' => 'updateDashboardParameters',
    ];

    public function updateParameters($jenjangId = null)
    {
        $this->selectedJenjang = $jenjangId;
        $this->selectedPeriode = null;
        $this->dashboardParametersReceived = false;
    }

    public function updateDashboardParameters($jenjangId = null, $periodeId = null)
    {
        $this->selectedJenjang = $jenjangId;
        $this->selectedPeriode = $periodeId;
        $this->dashboardParametersReceived = true;
    }


    public function render()
    {
        $periode = null;
        $kuota = 0;

        if ($this->dashboardParametersReceived) {
            $periode = PPDBPeriode::query()
                ->forAuthorizedJenjang(Auth::id())
                ->whereKey($this->selectedPeriode)
                ->where('ms_jenjang_id', $this->selectedJenjang)
                ->first();
        } elseif ($this->selectedJenjang) {
            $periode = PPDBPeriode::query()
                ->forAuthorizedJenjang(Auth::id())
                ->where('ms_jenjang_id', $this->selectedJenjang)
                ->where('status', 'aktif')
                ->orderByDesc('tanggal_mulai')
                ->orderByDesc('ppdb_periode_id')
                ->first();
        }

        if ($periode) {
            $kuota = PPDBJalur::query()
                ->where('ppdb_periode_id', $periode->ppdb_periode_id)
                ->where('status', 'aktif')
                ->sum('kuota');
        }

        return view('livewire.p-p-d-b.admin.dashboard.informasi-periode',
            compact('periode', 'kuota')
        );
    }
}
