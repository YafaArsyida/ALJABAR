<?php

namespace App\Http\Livewire\PPDB\Gelombang;

use App\Models\Jenjang;
use App\Models\PPDBGelombang;
use App\Models\PPDBPeriode;
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
        'refreshGelombangs' => '$refresh',
        'parameterUpdated' => 'updateParameters',
    ];


    /**
     * Memperbarui parameter jenjang.
     */
    public function updateParameters($jenjang)
    {
        $this->selectedJenjang = $jenjang;

        $this->namaJenjang = Jenjang::whereKey($jenjang)->value('nama_jenjang') ?? '-';
        $this->selectedPeriode = '';

        $this->parameterLoaded = true;

        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

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
        $gelombangs = collect();
        
        $select_periode = collect();

        if ($this->selectedJenjang) {
            $select_periode = PPDBPeriode::query()
                ->where('ms_jenjang_id', $this->selectedJenjang)
                ->orderBy('nama_periode')
                ->get();
        }

        if ($this->parameterLoaded && $this->selectedJenjang) {
            $gelombangs = PPDBGelombang::query()
                ->whereHas('ppdb_periode', function ($query) {
                    $query->where('ms_jenjang_id', $this->selectedJenjang);
                })
                ->with('ppdb_periode.ms_jenjang')
                ->when($this->search, function ($query) {
                    $query->where(function ($query) {
                        $query
                            ->where('nama_gelombang', 'like', '%' . $this->search . '%')
                            ->orWhereHas('ppdb_periode', function ($periode) {
                                $periode->where(
                                    'nama_periode',
                                    'like',
                                    '%' . $this->search . '%'
                                );
                            });
                    });
                })
                ->when($this->selectedPeriode, function ($query) {
                    $query->where(
                        'ppdb_periode_id',
                        $this->selectedPeriode
                    );
                })
                ->paginate(12);
        }

        return view('livewire.p-p-d-b.gelombang.index',[
            'gelombangs' => $gelombangs,
            'select_periode' => $select_periode
        ]);
    }
}
