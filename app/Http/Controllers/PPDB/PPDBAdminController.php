<?php

namespace App\Http\Controllers\PPDB;

use App\Http\Controllers\Controller;
use App\Models\PPDBBerkas;
use App\Models\PPDBPendaftaran;
use App\Services\PPDB\PPDBBerkasArsipService;
use App\Services\Reports\PPDBLaporanPendataanReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PPDBAdminController extends Controller
{
    public function index()
    {
        return view('ppdb.admin.index');
    }

    public function showBerkas(Request $request, $berkasId)
    {
        $berkas = PPDBBerkas::with('ppdb_pendaftaran')
            ->findOrFail($berkasId);

        abort_unless($berkas->ppdb_pendaftaran, 404);

        // Otorisasi petugas PPDB.
        $peran = strtoupper($request->user()->peran ?? '');

        abort_unless(
            in_array(
                $peran,
                ['SUPERADMIN', 'ADMIN', 'KEUANGAN', 'PETUGAS_PPDB'],
                true
            ),
            403
        );

        // Batasi format yang dapat ditampilkan.
        abort_unless(
            in_array($berkas->mime_type, [
                'image/webp',
                'image/jpeg',
                'image/png',
                'application/pdf',
            ], true),
            415
        );

        $disk = Storage::disk('local');
        $path = $berkas->path_file;

        abort_unless(
            $path && $disk->exists($path),
            404
        );

        return response()->file(
            $disk->path($path),
            [
                'Content-Type' => $berkas->mime_type,
                'Content-Disposition' =>
                    'inline; filename="' .
                    basename($berkas->nama_file) . '"',
                'X-Content-Type-Options' => 'nosniff',
            ]
        );
    }

    public function pendaftar()
    {
        return view('ppdb.admin.pendaftar');
    }

    public function verifikasi()
    {
        return view('ppdb.admin.verifikasi');
    }

    public function seleksi()
    {
        return view('ppdb.admin.seleksi');
    }

    public function pengumuman()
    {
        return view('ppdb.admin.pengumuman');
    }

    public function daftarUlang()
    {
        return view('ppdb.admin.daftar-ulang');
    }

    public function laporan()
    {
        return view('ppdb.admin.laporan');
    }

    public function cetakLaporan(
        Request $request,
        PPDBLaporanPendataanReportService $reportService
    ) {
        $filters = $request->validate([
            'jenjang' => ['required', 'integer'],
            'periode' => ['required', 'integer'],
            'jalur' => ['nullable', 'integer'],
            'search' => ['nullable', 'string', 'max:150'],
        ]);

        $data = $reportService->getData($filters, $request->user()->getKey());

        return Pdf::loadView('reports.ppdb.laporan-pendataan', $data)
            ->setPaper('a4', 'landscape')
            ->download('laporan-pendataan-spmb.pdf');
    }

    public function unduhBerkas(
        $pendaftaranId,
        PPDBBerkasArsipService $arsipService
    ) {
        $pendaftaran = PPDBPendaftaran::query()
            ->with('ppdb_calon_siswa')
            ->where('status', 'diterima')
            ->findOrFail($pendaftaranId);

        $arsip = $arsipService->buatArsip(
            (int) $pendaftaran->getKey(),
            $pendaftaran->ppdb_calon_siswa?->nama_siswa ?? 'Calon-Siswa'
        );

        return response()
            ->download($arsip['path'], $arsip['nama'])
            ->deleteFileAfterSend(true);
    }

    public function pengaturan()
    {
        return view('ppdb.admin.pengaturan');
    }

    public function aksesPetugas()
    {
        return view('ppdb.admin.akses-petugas');
    }
}
