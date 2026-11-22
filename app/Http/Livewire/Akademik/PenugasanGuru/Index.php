<?php

namespace App\Http\Livewire\Akademik\PenugasanGuru;

use App\Models\Jenjang;
use App\Models\TahunAjar;
use App\Http\Livewire\Akademik\PenugasanGuru\Concerns\InteractsWithPenugasanGuru;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use InteractsWithPenugasanGuru;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $selectedJenjang = null;
    public $selectedTahunAjar = null;
    public $namaJenjang = '';
    public $namaTahunAjar = '';

    protected $listeners = [
        'parameterUpdated' => 'updateParameters',
        'refreshPenugasanGurus' => '$refresh',
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
        $hasParameters = $this->hasValidContext($this->selectedJenjang, $this->selectedTahunAjar);

        $assignments = $this->assignmentsForContext($this->selectedJenjang, $this->selectedTahunAjar)
            ->with(['ms_pegawai', 'ms_kelas', 'ms_mata_pelajaran', 'ms_periode_akademik'])
            ->when($this->search, function ($query) {
                $search = '%' . $this->search . '%';
                $query->where(function ($searchQuery) use ($search) {
                    $searchQuery->whereHas('ms_pegawai', function ($related) use ($search) {
                        $related->where('nama_pegawai', 'like', $search)
                            ->orWhere('nip', 'like', $search);
                    })->orWhereHas('ms_kelas', fn ($related) => $related->where('nama_kelas', 'like', $search))
                        ->orWhereHas('ms_mata_pelajaran', function ($related) use ($search) {
                            $related->where('nama_mapel', 'like', $search)
                                ->orWhere('kode_mapel', 'like', $search);
                        })->orWhereHas('ms_periode_akademik', fn ($related) => $related->where('nama_periode', 'like', $search));
                });
            })
            ->when(!$hasParameters, fn ($query) => $query->whereRaw('1 = 0'))
            ->orderByDesc('ms_penugasan_guru_id')
            ->paginate(12);

        return view('livewire.akademik.penugasan-guru.index', [
            'assignments' => $assignments,
            'hasParameters' => $hasParameters,
        ]);
    }
}
