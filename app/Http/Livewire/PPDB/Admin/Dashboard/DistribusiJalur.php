<?php

namespace App\Http\Livewire\PPDB\Admin\Dashboard;

use Livewire\Component;
use App\Models\PPDBPeriode;
use App\Models\PPDBJalur;
use App\Models\PPDBPendaftaran;

class DistribusiJalur extends Component
{
    public $selectedJenjang = null;

    protected $listeners = [
        'parameterUpdated' => 'updateParameters',
    ];

    public function updateParameters($jenjangId = null)
    {
        $this->selectedJenjang = $jenjangId;
    }

    public function render()
    {
        $periode = null;
        $jalurPendaftaran = collect();
        $totalPendaftar = 0;

        if ($this->selectedJenjang) {
            $periode = PPDBPeriode::query()
                ->where('ms_jenjang_id', $this->selectedJenjang)
                ->where('status', 'aktif')
                ->orderByDesc('tanggal_mulai')
                ->orderByDesc('ppdb_periode_id')
                ->first();

            if ($periode) {
                $jalurPendaftaran = PPDBJalur::query()
                    ->where('ppdb_periode_id', $periode->ppdb_periode_id)
                    ->where('status', 'aktif')
                    ->withCount([
                        'ppdb_pendaftaran' => function ($query) {
                            $query->whereNotIn('status', ['pengecekan']);
                        },
                    ])
                    ->get()
                    ->map(function ($jalur) {
                        return [
                            'nama' => $jalur->nama_jalur,
                            'jumlah' => $jalur->ppdb_pendaftaran_count,
                        ];
                    });

                $totalPendaftar = $jalurPendaftaran->sum('jumlah');

                $warna = [
                    'primary',
                    'success',
                    'info',
                    'warning',
                    'danger',
                    'secondary',
                ];

                $jalurPendaftaran = $jalurPendaftaran
                    ->values()
                    ->map(function ($jalur, $index) use ($totalPendaftar, $warna) {
                        $jumlah = $jalur['jumlah'];

                        return [
                            'nama' => $jalur['nama'],
                            'jumlah' => $jumlah,
                            'persentase' => $totalPendaftar > 0
                                ? round(($jumlah / $totalPendaftar) * 100, 1)
                                : 0,
                            'color' => $warna[$index % count($warna)],
                        ];
                    });
            }
        }

        return view('livewire.p-p-d-b.admin.dashboard.distribusi-jalur',[
            'periode' => $periode,
            'jalurPendaftaran' => $jalurPendaftaran,
            'totalPendaftar' => $totalPendaftar,
        ]);
    }
}
