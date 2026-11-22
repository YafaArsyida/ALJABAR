<?php

namespace App\Http\Controllers;

use App\Models\PenugasanGuru;
use App\Http\Requests\StorePenugasanGuruRequest;
use App\Http\Requests\UpdatePenugasanGuruRequest;

class PenugasanGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('akademik.penugasan-guru');
    }
}
