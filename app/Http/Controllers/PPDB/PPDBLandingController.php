<?php

namespace App\Http\Controllers\PPDB;

use App\Http\Controllers\Controller;
use App\Models\Jenjang;

class PPDBLandingController extends Controller
{
    /**
     * Halaman utama PPDB.
     */
    public function index()
    {
        return view('ppdb.landing.pilih-jenjang');
    }

    public function sd()
    {
        $jenjang = Jenjang::where('slug', 'sd')
            ->where('status', 'aktif')
            ->firstOrFail();

        return view('ppdb.landing.sd', compact('jenjang'));
    }

    public function tk()
    {
        $jenjang = Jenjang::where('slug', 'tk')
            ->where('status', 'aktif')
            ->firstOrFail();

        return view('ppdb.landing.tk', compact('jenjang'));
    }

    public function kb_b()
    {
        $jenjang = Jenjang::where('slug', 'kb-b')
            ->where('status', 'aktif')
            ->firstOrFail();

        return view('ppdb.landing.kb_b', compact('jenjang'));
    }

    public function kb_a()
    {
        $jenjang = Jenjang::where('slug', 'kb-a')
            ->where('status', 'aktif')
            ->firstOrFail();

        return view('ppdb.landing.kb_a', compact('jenjang'));
    }

    public function login()
    {
        return view('ppdb.auth.login');
    }
}
