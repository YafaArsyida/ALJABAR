<?php

namespace App\Http\Livewire\PPDB\Periode;

use App\Models\Jenjang;
use App\Models\PPDBPeriode;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $parameterLoaded = false;

    public $search = '';
    public $selectedJenjang = null;

    public $namaJenjang = '';

    protected $listeners = [
        'refreshPeriodes' => '$refresh',
        'parameterUpdated' => 'updateParameters',
    ];

    /**
     * Memperbarui parameter jenjang.
     */
    public function updateParameters($jenjang)
    {
        $this->selectedJenjang = $jenjang;

        $this->namaJenjang = Jenjang::whereKey($jenjang)->value('nama_jenjang') ?? '-';

        $this->parameterLoaded = true;

        $this->resetPage();
    }

    /**
     * Reset pagination saat pencarian berubah.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $periodes = collect();

        if ($this->parameterLoaded && $this->selectedJenjang) {
            $periodes = PPDBPeriode::query()
                ->where('ms_jenjang_id', $this->selectedJenjang)
                ->when(
                    $this->search,
                    fn ($q) => $q->where(function ($query) {
                        $query->where(
                            'nama_periode',
                            'like',
                            '%' . $this->search . '%'
                        )->orWhere(
                            'tautan_grup',
                            'like',
                            '%' . $this->search . '%'
                        );
                    })
                )
                ->with('ms_jenjang')
                ->withCount('ppdb_gelombang')
                ->paginate(12);
        }

        return view('livewire.p-p-d-b.periode.index', [
            'periodes' => $periodes,
        ]);
    }
}
