<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use App\Services\Reports\DaftarSiswaEkstrakurikulerReportService;
use App\Services\Reports\EkstrakurikulerSiswaReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class EkstrakurikulerSiswa extends Controller
{
    public function index()
    {
        return view('akademik.ekstrakurikuler');
    }
    public function cetakPDF(
        Request $request,
        EkstrakurikulerSiswaReportService $reportService
    ) {
        $filters = $request->validate([
            'ekstrakurikuler_id' => ['required', 'integer'],
            'kelas' => ['nullable', 'integer'],
            'search' => ['nullable', 'string', 'max:150'],
        ]);

        $data = $reportService->getData($filters);

        return Pdf::loadView('reports.akademik.ekstrakurikuler-siswa', $data)
            ->setPaper('a4', 'portrait')
            ->download('data-ekstrakurikuler-siswa.pdf');
    }

    public function cetakSiswaPDF(
        Request $request,
        DaftarSiswaEkstrakurikulerReportService $reportService
    ) {
        $filters = $request->validate([
            'jenjang' => ['required', 'integer'],
            'tahun' => ['required', 'integer'],
            'kelas' => ['nullable', 'integer'],
            'search' => ['nullable', 'string', 'max:150'],
        ]);

        $data = $reportService->getData($filters);

        return Pdf::loadView('reports.akademik.daftar-siswa-ekstrakurikuler', $data)
            ->setPaper('a4', 'landscape')
            ->download('data-siswa-ekstrakurikuler.pdf');
    }
}
