<?php

namespace App\Services\Reports;

use App\Models\Jenjang;
use App\Models\PenempatanSiswa;
use App\Models\TahunAjar;

class DaftarSiswaEkstrakurikulerReportService
{
    public function getData(array $filters): array
    {
        $jenjang = Jenjang::query()->findOrFail($filters['jenjang']);
        $tahunAjar = TahunAjar::query()->findOrFail($filters['tahun']);
        $search = trim($filters['search'] ?? '');

        $siswa = PenempatanSiswa::query()
            ->with([
                'ms_siswa.ms_educard',
                'ms_kelas',
                'ms_penempatan_ekstrakurikuler.ms_ekstrakurikuler',
            ])
            ->join(
                'ms_siswa',
                'ms_penempatan_siswa.ms_siswa_id',
                '=',
                'ms_siswa.ms_siswa_id'
            )
            ->select('ms_penempatan_siswa.*')
            ->where('ms_penempatan_siswa.ms_jenjang_id', $jenjang->getKey())
            ->where('ms_penempatan_siswa.ms_tahun_ajar_id', $tahunAjar->getKey())
            ->when($filters['kelas'] ?? null, function ($query, $kelas) {
                $query->where('ms_penempatan_siswa.ms_kelas_id', $kelas);
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->whereHas('ms_siswa', function ($siswaQuery) use ($search) {
                        $siswaQuery->where('nama_siswa', 'like', '%' . $search . '%');
                    })->orWhereHas('ms_siswa.ms_educard', function ($educardQuery) use ($search) {
                        $educardQuery->where('kode_kartu', 'like', '%' . $search . '%');
                    });
                });
            })
            ->orderBy('ms_penempatan_siswa.ms_kelas_id')
            ->orderBy('ms_siswa.nama_siswa')
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
                    'biaya' => $penempatan
                        ? 'Rp' . number_format($ekstrakurikuler?->biaya ?? 0, 0, ',', '.')
                        : '-',
                ];
            });

        return [
            'judul' => 'Data Siswa Ekstrakurikuler',
            'jenjang' => $jenjang->nama_jenjang,
            'tahunAjar' => $tahunAjar->nama_tahun_ajar,
            'pencarian' => $search !== '' ? $search : 'Semua siswa',
            'dicetakPada' => now()->format('d/m/Y H:i'),
            'jumlahSiswa' => $siswa->count(),
            'data' => $siswa,
        ];
    }
}
