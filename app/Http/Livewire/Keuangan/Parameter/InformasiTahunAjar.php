<?php

namespace App\Http\Livewire\Keuangan\Parameter;

use App\Models\Jenjang;
use App\Models\TahunAjar;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InformasiTahunAjar extends Component
{
    public $heading = 'Dashboard Tata Usaha';
    public $showTahunAjar = true;
    public $selectedJenjang = null;
    public $selectedTahunAjar = null;

    public function mount($heading = null, $showTahunAjar = true)
    {
        if ($heading) {
            $this->heading = $heading;
        }

        $this->showTahunAjar = $showTahunAjar;
    }

    protected $listeners = [
        'parameterUpdated' => 'updateParameters',
    ];

    public function updateParameters($jenjangId = null, $tahunAjarId = null)
    {
        $this->selectedJenjang = $jenjangId;
        $this->selectedTahunAjar = $tahunAjarId;
    }

    public function render()
    {
        $jenjang = null;
        $tahunAjar = null;

        if ($this->selectedJenjang) {
            $jenjang = Jenjang::whereIn('ms_jenjang_id', function ($query) {
                $query->select('ms_jenjang_id')
                    ->from('ms_akses_jenjang')
                    ->where('ms_pengguna_id', Auth::id());
            })
                ->where('status', 'Aktif')
                ->whereKey($this->selectedJenjang)
                ->first();
        }

        if ($this->showTahunAjar && $this->selectedTahunAjar) {
            $tahunAjar = TahunAjar::where('status', 'Aktif')
                ->whereKey($this->selectedTahunAjar)
                ->first();
        }

        return view('livewire.keuangan.parameter.informasi-tahun-ajar', compact('jenjang', 'tahunAjar'));
    }
}
