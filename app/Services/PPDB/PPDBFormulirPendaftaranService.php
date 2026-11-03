<?php

namespace App\Services\PPDB;

use App\Models\PPDBJawaban;
use App\Models\PPDBPendaftaran;
use Illuminate\Support\Facades\Storage;

class PPDBFormulirPendaftaranService
{
    public function getData(PPDBPendaftaran $pendaftaran): array
    {
        $pendaftaran->loadMissing([
            'ppdb_calon_siswa',
            'ppdb_orangtua',
            'ppdb_alamat',
            'ppdb_pendidikan',
            'ppdb_periode.ms_jenjang',
        ]);

        $jawaban = PPDBJawaban::query()
            ->with('ppdb_pertanyaan')
            ->where(
                'ppdb_pendaftaran_id',
                $pendaftaran->getKey()
            )
            ->where(
                'ppdb_periode_id',
                $pendaftaran->ppdb_periode_id
            )
            ->get();

        $jenjang = $pendaftaran->ppdb_periode?->ms_jenjang;
        $berkasFoto = $pendaftaran->ppdb_berkas()
            ->where('jenis_berkas', 'PAS_FOTO')
            ->first();
        $fotoSiswa = null;

        if ($berkasFoto && in_array($berkasFoto->mime_type, [
            'image/webp',
            'image/jpeg',
            'image/png',
        ], true)) {
            $disk = Storage::disk('local');
            $direktoriRelatif = 'ppdb/berkas/' . $pendaftaran->getKey();
            $direktori = realpath($disk->path($direktoriRelatif));
            $pathRelatif = $berkasFoto->path_file;
            $prefix = $direktoriRelatif . '/';

            if (
                $direktori !== false
                && is_string($pathRelatif)
                && str_starts_with($pathRelatif, $prefix)
                && ! str_contains($pathRelatif, '..')
                && ! str_contains($pathRelatif, '\\')
            ) {
                $pathFoto = realpath($disk->path($pathRelatif));

                if (
                    $pathFoto !== false
                    && str_starts_with(
                        $pathFoto,
                        $direktori . DIRECTORY_SEPARATOR
                    )
                    && is_file($pathFoto)
                ) {
                    $fotoSiswa = 'data:' . $berkasFoto->mime_type
                        . ';base64,' . base64_encode(file_get_contents($pathFoto));
                }
            }
        }

        return [
            'pendaftaran' => $pendaftaran,
            'calonSiswa' => $pendaftaran->ppdb_calon_siswa,
            'orangTua' => $pendaftaran->ppdb_orangtua,
            'alamat' => $pendaftaran->ppdb_alamat,
            'pendidikan' => $pendaftaran->ppdb_pendidikan,
            'jawaban' => $jawaban,
            'fotoSiswa' => $fotoSiswa,

            'jenjang' => $jenjang,
            'namaJenjang' => $jenjang?->nama_jenjang,
            'alamatSekolah' => $jenjang?->alamat,
        ];
    }
}