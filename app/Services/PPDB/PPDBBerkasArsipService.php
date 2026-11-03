<?php

namespace App\Services\PPDB;

use App\Models\PPDBBerkas;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class PPDBBerkasArsipService
{
    public function buatArsip(int $pendaftaranId, string $namaSiswa): array
    {
        if (! class_exists(\ZipArchive::class)) {
            throw new RuntimeException(
                'Ekstensi ZIP belum tersedia pada server.'
            );
        }

        $berkas = PPDBBerkas::query()
            ->where('ppdb_pendaftaran_id', $pendaftaranId)
            ->orderBy('ppdb_berkas_id')
            ->get();

        if ($berkas->isEmpty()) {
            abort(404, 'Berkas calon siswa belum tersedia.');
        }

        $disk = Storage::disk('local');
        $direktoriRelatif = 'ppdb/berkas/' . $pendaftaranId;
        $direktori = realpath($disk->path($direktoriRelatif));

        if ($direktori === false) {
            abort(404, 'Direktori berkas calon siswa tidak ditemukan.');
        }

        $pathArsip = tempnam(sys_get_temp_dir(), 'spmb-berkas-');
        if ($pathArsip === false) {
            throw new RuntimeException('Arsip ZIP tidak dapat disiapkan.');
        }

        $zip = new \ZipArchive();
        $hasilBuka = $zip->open(
            $pathArsip,
            \ZipArchive::CREATE | \ZipArchive::OVERWRITE
        );

        if ($hasilBuka !== true) {
            unlink($pathArsip);
            throw new RuntimeException('Arsip ZIP tidak dapat dibuat.');
        }

        $namaTerpakai = [];

        try {
            foreach ($berkas as $item) {
                $pathRelatif = $item->path_file;
                $prefix = $direktoriRelatif . '/';

                if (
                    ! is_string($pathRelatif)
                    || ! str_starts_with($pathRelatif, $prefix)
                    || str_contains($pathRelatif, '..')
                    || str_contains($pathRelatif, '\\')
                ) {
                    abort(404, 'Lokasi berkas calon siswa tidak valid.');
                }

                $pathFisik = realpath($disk->path($pathRelatif));
                if (
                    $pathFisik === false
                    || ! str_starts_with(
                        $pathFisik,
                        $direktori . DIRECTORY_SEPARATOR
                    )
                ) {
                    abort(404, 'Berkas calon siswa tidak ditemukan.');
                }

                $ekstensi = [
                    'application/pdf' => 'pdf',
                    'image/webp' => 'webp',
                    'image/jpeg' => 'jpg',
                    'image/png' => 'png',
                ][$item->mime_type] ?? null;

                if ($ekstensi === null) {
                    abort(415, 'Format berkas calon siswa tidak didukung.');
                }

                $namaDasar = [
                    'KARTU_KELUARGA' => 'Kartu-Keluarga',
                    'AKTA_KELAHIRAN' => 'Akta-Kelahiran',
                    'PAS_FOTO' => 'Pas-Foto',
                    'DOKUMEN_PENDUKUNG' => 'Dokumen-Pendukung',
                ][$item->jenis_berkas] ?? 'Berkas-Lainnya';

                $namaEntry = $namaDasar . '.' . $ekstensi;
                $nomorDuplikat = 2;
                while (isset($namaTerpakai[$namaEntry])) {
                    $namaEntry = $namaDasar . '-' . $nomorDuplikat . '.' . $ekstensi;
                    $nomorDuplikat++;
                }
                $namaTerpakai[$namaEntry] = true;

                if (! $zip->addFile($pathFisik, $namaEntry)) {
                    throw new RuntimeException(
                        'Berkas calon siswa gagal dimasukkan ke arsip ZIP.'
                    );
                }
            }

            if (! $zip->close()) {
                throw new RuntimeException('Arsip ZIP gagal diselesaikan.');
            }
        } catch (\Throwable $exception) {
            $zip->close();
            if (is_file($pathArsip)) {
                unlink($pathArsip);
            }

            throw $exception;
        }

        $namaAman = preg_replace(
            '/[\\\\\/:*?"<>|\x00-\x1F]/u',
            '-',
            trim($namaSiswa)
        );
        $namaAman = trim($namaAman ?? '', " .-_");

        return [
            'path' => $pathArsip,
            'nama' => ($namaAman !== '' ? $namaAman : 'Calon-Siswa') . '.zip',
        ];
    }
}
