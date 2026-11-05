<?php

namespace App\Http\Livewire\PPDB\Admin\Dashboard;

use Livewire\Component;
use App\Models\PPDBPeriode;
use App\Models\PPDBPendaftaran;
use Illuminate\Support\Facades\Auth;

class PendaftarTerbaru extends Component
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
        $pendaftarTerbaru = collect();

        if ($this->selectedJenjang && $this->selectedPeriode) {
            $periode = PPDBPeriode::query()
                ->forAuthorizedJenjang(Auth::id())
                ->whereKey($this->selectedPeriode)
                ->where('ms_jenjang_id', $this->selectedJenjang)
                ->first();

            if ($periode) {
                $pendaftarTerbaru = PPDBPendaftaran::query()
                    ->where('ppdb_periode_id', $periode->ppdb_periode_id)
                    ->with([
                        'ppdb_jalur',
                        'ppdb_calon_siswa',
                        'ms_pengguna',
                    ])
                    ->latest('created_at')
                    ->take(10)
                    ->get()
                    ->map(function ($pendaftar) {
                        $status = $pendaftar->status;

                        $statusLabel = [
                            'draft' => 'Proses Pengisian',
                            'pengecekan' => 'Menunggu Verifikasi',
                            'perbaikan' => 'Perlu Perbaikan',
                            'diterima' => 'Diterima',
                        ];

                        $statusBadge = [
                            'draft' => 'primary',
                            'pengecekan' => 'warning',
                            'perbaikan' => 'danger',
                            'diterima' => 'success',
                        ];

                        return [
                            'nama' => $pendaftar->ppdb_calon_siswa->nama_siswa
                                ?? '-',

                            'nomor' => $pendaftar->nomor_pendaftaran
                                ?? '-',

                            'jalur' => $pendaftar->ppdb_jalur->nama_jalur
                                ?? '-',

                            'sumber' => $pendaftar->ms_pengguna
                                && $pendaftar->ms_pengguna->peran === 'ORANG_TUA'
                                    ? 'Orang tua'
                                    : 'Petugas SPMB',

                            'tanggal' => $pendaftar->created_at
                                ? $pendaftar->created_at->translatedFormat('d M Y')
                                : '-',

                            'status' => $statusLabel[$status] ?? ucfirst($status),

                            'badge' => $statusBadge[$status] ?? 'secondary',

                            'ppdb_pendaftaran_id' => $pendaftar->ppdb_pendaftaran_id,
                        ];
                    });
            }
        }

        return view('livewire.p-p-d-b.admin.dashboard.pendaftar-terbaru',[
            'periode' => $periode,
            'pendaftarTerbaru' => $pendaftarTerbaru,
        ]);
    }
}
