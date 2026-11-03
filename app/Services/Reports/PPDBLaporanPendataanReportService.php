<?php

namespace App\Services\Reports;

use App\Models\Jenjang;
use App\Models\PPDBJalur;
use App\Models\PPDBPendaftaran;
use App\Models\PPDBPeriode;
use App\Models\TahunAjar;
use App\Http\Controllers\HelperController;

class PPDBLaporanPendataanReportService
{
    public function getData(array $filters): array
    {
        $jenjang = Jenjang::findOrFail($filters['jenjang']);
        $tahunAjar = TahunAjar::findOrFail($filters['tahun']);

        $periode = PPDBPeriode::query()
            ->where('ms_jenjang_id', $jenjang->getKey())
            ->where('ms_tahun_ajar_id', $tahunAjar->getKey())
            ->where('status', 'aktif')
            ->firstOrFail();

        $jalur = null;
        if (! empty($filters['jalur'])) {
            $jalur = PPDBJalur::query()
                ->where('ppdb_periode_id', $periode->getKey())
                ->where('status', 'aktif')
                ->findOrFail($filters['jalur']);
        }

        $search = trim($filters['search'] ?? '');

        $pendaftar = PPDBPendaftaran::query()
            ->with(['ppdb_calon_siswa', 'ppdb_jalur', 'ppdb_orangtua'])
            ->where('ppdb_periode_id', $periode->getKey())
            ->where('status', 'diterima')
            ->when($jalur, function ($query) use ($jalur) {
                $query->where('ppdb_jalur_id', $jalur->getKey());
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nomor_pendaftaran', 'like', '%' . $search . '%')
                        ->orWhereHas('ppdb_calon_siswa', function ($siswa) use ($search) {
                            $siswa->where('nama_siswa', 'like', '%' . $search . '%');
                        });
                });
            })
            ->latest('created_at')
            ->get()
            ->values()
            ->map(function (PPDBPendaftaran $item, int $index) {
                $tanggalPendataan = $item->submitted_at ?: $item->created_at;

                return [
                    'nomor' => $index + 1,
                    'nama' => $item->ppdb_calon_siswa?->nama_siswa ?? '-',
                    'nomorPendataan' => $item->nomor_pendaftaran ?? '-',
                    'jalur' => $item->ppdb_jalur?->nama_jalur ?? '-',
                    'tanggalPendataan' => $tanggalPendataan
                        ? HelperController::formatTanggalIndonesia($tanggalPendataan, 'd F Y')
                        : '-',
                    'telepon' => $item->ppdb_orangtua?->telepon_ayah
                        ?: ($item->ppdb_orangtua?->telepon_ibu
                        ?: ($item->ppdb_orangtua?->telepon_wali ?? '-')),
                ];
            });

        return [
            'judul' => 'Laporan Pendataan SPMB',
            'jenjang' => $jenjang->nama_jenjang,
            'tahunAjar' => $tahunAjar->nama_tahun_ajar,
            'periode' => $periode->nama_periode,
            'jalur' => $jalur?->nama_jalur ?? 'Semua jalur',
            'pencarian' => $search !== '' ? $search : 'Semua calon siswa',
            'dicetakPada' => now()->format('d/m/Y H:i'),
            'jumlahCalonSiswa' => $pendaftar->count(),
            'data' => $pendaftar,
        ];
    }
}
