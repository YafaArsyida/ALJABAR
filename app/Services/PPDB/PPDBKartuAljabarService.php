<?php

namespace App\Services\PPDB;

use App\Models\PPDBPendaftaran;
use Carbon\Carbon;

class PPDBKartuAljabarService
{
    public function getView(PPDBPendaftaran $pendaftaran): string
    {
        $slugJenjang = mb_strtolower(trim(
            (string) $pendaftaran->ppdb_periode?->ms_jenjang?->slug
        ));

        return match ($slugJenjang) {
            'sd' => 'reports.ppdb.kartu-aljabar-sd',
            'tk' => 'reports.ppdb.kartu-aljabar-tk',
            'kb' => 'reports.ppdb.kartu-aljabar-kb',
            default => abort(
                422,
                'Desain kartu belum tersedia untuk jenjang pendaftaran ini.'
            ),
        };
    }

    public function getData(PPDBPendaftaran $pendaftaran): array
    {
        $pendaftaran->loadMissing([
            'ppdb_calon_siswa',
            'ppdb_orangtua',
            'ppdb_jalur',
        ]);

        $siswa = $pendaftaran->ppdb_calon_siswa;
        $orangTua = $pendaftaran->ppdb_orangtua;
        $jalur = $pendaftaran->ppdb_jalur;
        $tanggalLahir = $siswa?->tanggal_lahir;
        $kodeJalur = mb_strtolower(trim((string) $jalur?->kode_jalur));
        $namaJalur = mb_strtolower(trim((string) $jalur?->nama_jalur));

        return [
            'nomor_pendaftaran' => $pendaftaran->nomor_pendaftaran,
            'nama_siswa' => $siswa?->nama_siswa ?? '-',
            'tempat_lahir' => $siswa?->tempat_lahir ?? '-',
            'tanggal_lahir' => $tanggalLahir
                ? Carbon::parse($tanggalLahir)
                    ->locale('id')
                    ->translatedFormat('d F Y')
                : '-',
            'jenis_kelamin' => $siswa?->jenis_kelamin ?? '-',
            'nama_jalur' => $jalur?->nama_jalur ?? '-',
            'is_jalur_alumni' => str_contains($kodeJalur, 'alumni')
                || str_contains($namaJalur, 'alumni'),
            'telepon' => $orangTua?->telepon_ayah
                ?: ($orangTua?->telepon_ibu
                ?: ($orangTua?->telepon_wali ?? '-')),
        ];
    }
}
