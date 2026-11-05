<?php

namespace App\Http\Livewire\PPDB\Admin\Dashboard;

use Livewire\Component;
use App\Models\PPDBPeriode;
use App\Models\PPDBJalur;

class InformasiPeriode extends Component
{
    public $selectedJenjang = null;
    protected $listeners = [
        'parameterUpdated' => 'updateParameters',
    ];

    public function updateParameters($jenjangId = null, $tahunAjarId = null)
    {
        $this->selectedJenjang = $jenjangId;
    }


    public function render()
    {
        $periode = null;
        $kuota = 0;

        if ($this->selectedJenjang) {
            $periode = PPDBPeriode::query()
                ->where('ms_jenjang_id', $this->selectedJenjang)
                ->where('status', 'aktif')
                ->orderByDesc('tanggal_mulai')
                ->first();

            if ($periode) {
                $kuota = PPDBJalur::query()
                    ->where('ppdb_periode_id', $periode->ppdb_periode_id)
                    ->where('status', 'aktif')
                    ->sum('kuota');
            }
        }

        return view('livewire.p-p-d-b.admin.dashboard.informasi-periode',
            compact('periode', 'kuota')
        );
    }
}
