<?php

namespace App\Http\Livewire\Akademik\PeriodeAkademik;

use App\Models\Jenjang;
use App\Models\PeriodeAkademik;
use App\Models\TahunAjar;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $selectedJenjang = null;
    public $selectedTahunAjar = null;
    public $namaJenjang = '';
    public $namaTahunAjar = '';

    protected $listeners = [
        'parameterUpdated' => 'updateParameters',
        'refreshPeriodeAkademiks' => '$refresh',
    ];

    public function updateParameters($jenjang, $tahunAjar)
    {
        $this->selectedJenjang = $jenjang;
        $this->selectedTahunAjar = $tahunAjar;
        $this->namaJenjang = $jenjang
            ? Jenjang::whereKey($jenjang)->value('nama_jenjang') ?? ''
            : '';
        $this->namaTahunAjar = $tahunAjar
            ? TahunAjar::whereKey($tahunAjar)->value('nama_tahun_ajar') ?? ''
            : '';

        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $hasParameters = $this->selectedJenjang && $this->selectedTahunAjar;

        $query = PeriodeAkademik::query()
            ->with(['ms_jenjang', 'ms_tahun_ajar'])
            ->when($hasParameters, function ($query) {
                $query->where('ms_jenjang_id', $this->selectedJenjang)
                    ->where('ms_tahun_ajar_id', $this->selectedTahunAjar);
            }, function ($query) {
                $query->whereRaw('1 = 0');
            })
            ->when($this->search, function ($query) {
                $query->where(function ($searchQuery) {
                    $searchQuery->where('nama_periode', 'like', '%' . $this->search . '%')
                        ->orWhere('deskripsi', 'like', '%' . $this->search . '%');
                });
            });

        $periods = $query
            ->orderBy('urutan')
            ->orderBy('tanggal_mulai')
            ->paginate(12);

        return view('livewire.akademik.periode-akademik.index', [
            'periods' => $periods,
            'hasParameters' => $hasParameters,
        ]);
    }
}
