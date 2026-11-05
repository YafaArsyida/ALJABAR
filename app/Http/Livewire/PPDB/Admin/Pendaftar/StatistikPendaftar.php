<?php

namespace App\Http\Livewire\PPDB\Admin\Pendaftar;

use Livewire\Component;
use App\Models\PPDBPeriode;
use App\Models\PPDBPendaftaran;
use App\Models\Jenjang;
use Illuminate\Support\Facades\Auth;

class StatistikPendaftar extends Component
{
    public $selectedJenjang = null;
    public $selectedPeriode = null;

    protected $listeners = [
        'dashboardParametersUpdated' => 'updateParameters',
    ];

    public function updateParameters($jenjangId = null, $periodeId = null)
    {
        $jenjang = Jenjang::query()
            ->whereKey($jenjangId)
            ->where('status', 'Aktif')
            ->whereHas('ms_pengguna', function ($query) {
                $query->whereKey(Auth::id());
            })
            ->first();

        $this->selectedJenjang = $jenjang?->ms_jenjang_id;
        $this->selectedPeriode = $this->selectedJenjang && $periodeId
            ? PPDBPeriode::query()
                ->forAuthorizedJenjang(Auth::id())
                ->whereKey($periodeId)
                ->where('ms_jenjang_id', $this->selectedJenjang)
                ->value('ppdb_periode_id')
            : null;
    }

    public function render()
    {
        $totalPendaftar = 0;
        $menungguVerifikasi = 0;
        $terverifikasi = 0;
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

                $totalPendaftar = (clone $query)->count();

                $menungguVerifikasi = (clone $query)
                    ->where('status', 'pengecekan')
                    ->count();

                $terverifikasi = (clone $query)
                    ->where('status', 'diterima')
                    ->count();

                $perluPerbaikan = (clone $query)
                    ->where('status', 'perbaikan')
                    ->count();
            }
        }

        return view('livewire.p-p-d-b.admin.pendaftar.statistik-pendaftar',
            compact(
                'totalPendaftar',
                'menungguVerifikasi',
                'terverifikasi',
                'perluPerbaikan'
            )
        );
    }
}
