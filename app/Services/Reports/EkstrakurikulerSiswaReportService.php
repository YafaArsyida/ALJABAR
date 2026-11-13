<?php

namespace App\Services\Reports;

use App\Models\Ekstrakurikuler;
use App\Models\PenempatanSiswa;

class EkstrakurikulerSiswaReportService
{
    public function getData(array $filters): array
    {
        $ekstrakurikuler = Ekstrakurikuler::query()
            ->with(['ms_jenjang', 'ms_tahun_ajar'])
            ->findOrFail($filters['ekstrakurikuler_id']);

        $search = trim($filters['search'] ?? '');

        $siswa = PenempatanSiswa::query()
            ->with([
                'ms_siswa',
                'ms_kelas',
                'ms_penempatan_ekstrakurikuler.ms_ekstrakurikuler',
            ])
            ->where('ms_jenjang_id', $ekstrakurikuler->ms_jenjang_id)
            ->whereHas('ms_penempatan_ekstrakurikuler', function ($query) use ($ekstrakurikuler) {
                $query->where('ms_ekstrakurikuler_id', $ekstrakurikuler->getKey());
            })
            ->when($filters['kelas'] ?? null, function ($query, $kelas) {
                $query->where('ms_kelas_id', $kelas);
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->whereHas('ms_siswa', function ($siswaQuery) use ($search) {
                    $siswaQuery->where('nama_siswa', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('ms_kelas_id')
            ->get()
            ->values()
            ->map(function (PenempatanSiswa $item, int $index) {
                $penempatan = $item->ms_penempatan_ekstrakurikuler;
                $ekstrakurikuler = $penempatan?->ms_ekstrakurikuler;

                return [
                    'nomor' => $index + 1,
                    'nama' => $item->ms_siswa?->nama_siswa ?? '-',
                    'kelas' => $item->ms_kelas?->nama_kelas ?? '-',
                    'ekstrakurikuler' => $ekstrakurikuler?->nama_ekstrakurikuler ?? '-',
                    'biaya' => number_format($ekstrakurikuler?->biaya ?? 0, 0, ',', '.'),
                ];
            });

        return [
            'judul' => 'Data Ekstrakurikuler Siswa',
            'namaEkstrakurikuler' => $ekstrakurikuler->nama_ekstrakurikuler,
            'jenjang' => $ekstrakurikuler->ms_jenjang?->nama_jenjang ?? '-',
            'tahunAjar' => $ekstrakurikuler->ms_tahun_ajar?->nama_tahun_ajar ?? '-',
            'pencarian' => $search !== '' ? $search : 'Semua siswa',
            'dicetakPada' => now()->format('d/m/Y H:i'),
            'jumlahSiswa' => $siswa->count(),
            'data' => $siswa,
        ];
    }
}
