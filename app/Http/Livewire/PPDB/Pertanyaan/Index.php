<?php

namespace App\Http\Livewire\PPDB\Pertanyaan;

use App\Models\Jenjang;
use App\Models\PPDBPeriode;
use App\Models\PPDBPertanyaan;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $selectedJenjang;
    public $parameterLoaded = false;

    public $search = '';
    public $namaJenjang = '';
    public $selectedPeriode = '';

    protected $listeners = [
        'refreshPertanyaans' => '$refresh',
        'parameterUpdated' => 'updateParameters',
    ];

    /**
     * Memperbarui parameter jenjang.
     */
    public function updateParameters($jenjang)
    {
        $this->selectedJenjang = $jenjang;

        $this->namaJenjang = Jenjang::whereKey($jenjang)
            ->value('nama_jenjang') ?? '-';

        $this->parameterLoaded = true;
        $this->selectedPeriode = '';

        $this->resetPage();
    }

    /**
     * Reset pagination ketika pencarian berubah.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Reset pagination ketika periode berubah.
     */
    public function updatedSelectedPeriode()
    {
        $this->resetPage();
    }

    public function updatedSelectedJenjang()
    {
        $this->resetPage();
    }

    public function render()
    {
         $pertanyaans = collect();
        $select_periode = collect();

        if ($this->selectedJenjang) {
            $select_periode = PPDBPeriode::query()
                ->where('ms_jenjang_id', $this->selectedJenjang)
                ->orderBy('nama_periode')
                ->get();
        }

        if ($this->parameterLoaded && $this->selectedJenjang) {
            $pertanyaans = PPDBPertanyaan::query()
                ->with('ppdb_periode.ms_jenjang')
                ->whereHas('ppdb_periode', function ($query) {
                    $query->where('ms_jenjang_id', $this->selectedJenjang);
                })
                ->when($this->search, function ($query) {
                    $query->where(function ($query) {
                        $query
                            ->where(
                                'pertanyaan',
                                'like',
                                '%' . $this->search . '%'
                            )
                            ->orWhereHas(
                                'ppdb_periode',
                                function ($periode) {
                                    $periode->where(
                                        'nama_periode',
                                        'like',
                                        '%' . $this->search . '%'
                                    );
                                }
                            );
                    });
                })
                ->when($this->selectedPeriode, function ($query) {
                    $query->where(
                        'ppdb_periode_id',
                        $this->selectedPeriode
                    );
                })
                ->orderBy('ppdb_periode_id')
                ->orderBy('urutan')
                ->orderBy('ppdb_pertanyaan_id')
                ->paginate(12);
        }

        return view('livewire.p-p-d-b.pertanyaan.index',[
            'pertanyaans' => $pertanyaans,
            'select_periode' => $select_periode,
        ]);
    }
}
