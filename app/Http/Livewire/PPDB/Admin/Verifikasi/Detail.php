<?php

namespace App\Http\Livewire\PPDB\Admin\Verifikasi;

use App\Models\PPDBPendaftaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Detail extends Component
{
    public $pendaftaran = null;
    public $pendaftaranId = null;

    protected $listeners = [
        'bukaPemeriksaan' => 'loadPemeriksaan',
        'pendaftaranDiperbarui' => '$refresh',
    ];

    public function loadPemeriksaan($id)
    {
        $this->reset([
            'pendaftaran',
            'pendaftaranId',
        ]);

        $this->pendaftaranId = $id;

        $this->pendaftaran = PPDBPendaftaran::query()
            ->whereHas('ppdb_periode', function ($query) {
                $query->forAuthorizedJenjang(Auth::id());
            })
            ->with([
                'ppdb_periode',
                'ppdb_gelombang',
                'ppdb_jalur',
                'ppdb_calon_siswa',
                'ppdb_orangtua',
                'ppdb_alamat',
                'ppdb_pendidikan',
                'ppdb_berkas',
                'ms_pengguna',
            ])
            ->findOrFail($id);
    }
    public function render()
    {
        return view('livewire.p-p-d-b.admin.verifikasi.detail');
    }
}
