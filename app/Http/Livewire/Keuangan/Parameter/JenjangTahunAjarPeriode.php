<?php

namespace App\Http\Livewire\Keuangan\Parameter;

use App\Models\Jenjang;
use App\Models\PeriodeAkademik;
use App\Models\TahunAjar;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class JenjangTahunAjarPeriode extends Component
{
    public $selectedJenjang = null;
    public $selectedTahunAjar = null;
    public $selectedPeriode = null;

    protected $listeners = [
        'refreshParameters',
    ];

    public function mount()
    {
        // Jenjang pertama yang dapat diakses pengguna
        $firstJenjang = Jenjang::whereIn('ms_jenjang_id', function ($query) {
            $query->select('ms_jenjang_id')
                ->from('ms_akses_jenjang')
                ->where('ms_pengguna_id', Auth::id());
        })
            ->where('status', 'Aktif')
            ->orderBy('ms_jenjang_id')
            ->first();

        // Tahun ajaran aktif
        $firstTahunAjar = TahunAjar::where('status', 'Aktif')
            ->orderBy('urutan', 'asc')
            ->first();

        $this->selectedJenjang = $firstJenjang->ms_jenjang_id ?? null;
        $this->selectedTahunAjar = $firstTahunAjar->ms_tahun_ajar_id ?? null;

        // Periode pertama yang tersedia untuk kombinasi parameter
        $this->setDefaultPeriode();
    }

    public function updatedSelectedJenjang()
    {
        $this->setDefaultPeriode();
        $this->checkAndEmitParameters();
    }

    public function updatedSelectedTahunAjar()
    {
        $this->setDefaultPeriode();
        $this->checkAndEmitParameters();
    }

    public function updatedSelectedPeriode()
    {
        $this->checkAndEmitParameters();
    }

    /**
     * Mengambil periode akademik pertama berdasarkan
     * jenjang dan tahun ajaran yang dipilih.
     */
    private function setDefaultPeriode()
    {
        $this->selectedPeriode = null;

        if (!$this->selectedJenjang || !$this->selectedTahunAjar) {
            return;
        }

        $periode = PeriodeAkademik::where('ms_jenjang_id', $this->selectedJenjang)
            ->where('ms_tahun_ajar_id', $this->selectedTahunAjar)
            ->where('status', 'Aktif')
            ->orderBy('urutan', 'asc')
            ->first();

        $this->selectedPeriode = $periode->ms_periode_akademik_id ?? null;
    }

    /**
     * Emit parameter ke komponen lain.
     */
    private function checkAndEmitParameters()
    {
        if (
            $this->selectedJenjang !== null &&
            $this->selectedTahunAjar !== null &&
            $this->selectedPeriode !== null
        ) {
            $this->emit(
                'parameterUpdated',
                $this->selectedJenjang,
                $this->selectedTahunAjar,
                $this->selectedPeriode
            );

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Memperbarui parameter...'
            ]);
        } else {
            $this->emit('parameterUpdated', null, null, null);
        }
    }

    /**
     * Reset seluruh parameter.
     */
    public function refreshParameters()
    {
        $this->selectedJenjang = null;
        $this->selectedTahunAjar = null;
        $this->selectedPeriode = null;

        $this->emit('parameterUpdated', null, null, null);
    }

    public function render()
    {
        $selectJenjang = Jenjang::whereIn('ms_jenjang_id', function ($query) {
            $query->select('ms_jenjang_id')
                ->from('ms_akses_jenjang')
                ->where('ms_pengguna_id', Auth::id());
        })
            ->where('status', 'Aktif')
            ->orderBy('ms_jenjang_id')
            ->get();

        $selectTahunAjar = TahunAjar::where('status', 'Aktif')
            ->orderBy('urutan', 'asc')
            ->get();

        $selectPeriode = collect();

        if ($this->selectedJenjang && $this->selectedTahunAjar) {
            $selectPeriode = PeriodeAkademik::where(
                'ms_jenjang_id',
                $this->selectedJenjang
            )
                ->where('ms_tahun_ajar_id', $this->selectedTahunAjar)
                ->where('status', 'Aktif')
                ->orderBy('urutan', 'asc')
                ->get();
        }

        return view('livewire.keuangan.parameter.jenjang-tahun-ajar-periode',[
            'select_jenjang' => $selectJenjang,
            'select_tahun_ajar' => $selectTahunAjar,
            'select_periode' => $selectPeriode,
        ]);
    }
}
