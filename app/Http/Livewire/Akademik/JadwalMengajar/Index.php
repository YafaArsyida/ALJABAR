<?php

namespace App\Http\Livewire\Akademik\JadwalMengajar;

use Livewire\Component;

class Index extends Component
{
    public $selectedJenjang = null;
    public $selectedTahunAjar = null;
    public $selectedPeriode = null;

    // Filter tampilan
    public $modeTampilan = 'kelas';
    public $selectedKelas = '1A';
    public $selectedGuru = null;
    public $selectedHari = 'Senin';
    public $search = '';

    protected $listeners = [
        'jadwalParameterUpdated' => 'parameterUpdated',
    ];

    public function parameterUpdated($jenjangId, $tahunAjarId, $periodeId)
    {
        $this->selectedJenjang = $jenjangId;
        $this->selectedTahunAjar = $tahunAjarId;
        $this->selectedPeriode = $periodeId;

        // Reset filter kontekstual ketika parameter akademik berubah
        $this->selectedKelas = null;
        $this->selectedGuru = null;
        $this->selectedHari = 'Senin';
        $this->search = '';
    }

    public function setModeTampilan($mode)
    {
        if (!in_array($mode, ['kelas', 'guru', 'semua'])) {
            return;
        }

        $this->modeTampilan = $mode;

        // Reset pilihan sesuai mode
        $this->selectedKelas = null;
        $this->selectedGuru = null;
        $this->search = '';
    }

    public function setHari($hari)
    {
        $daftarHari = [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
        ];

        if (in_array($hari, $daftarHari)) {
            $this->selectedHari = $hari;
        }
    }

    public function resetFilter()
    {
        $this->search = '';
        $this->selectedHari = 'Senin';

        if ($this->modeTampilan === 'kelas') {
            $this->selectedKelas = null;
        } elseif ($this->modeTampilan === 'guru') {
            $this->selectedGuru = null;
        }
    }

    public function render()
    {
        return view('livewire.akademik.jadwal-mengajar.index');
    }
}
