<?php

namespace App\Http\Livewire\Akademik\MataPelajaran;

use App\Models\Jenjang;
use App\Models\MataPelajaran;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $selectedJenjang = null;
    public $namaJenjang = '';

    protected $listeners = [
        'parameterUpdated' => 'updateParameters',
        'refreshMataPelajarans' => '$refresh',
    ];

    public function updateParameters($jenjang, $tahunAjar = null)
    {
        $this->selectedJenjang = $jenjang;
        $this->namaJenjang = $jenjang
            ? Jenjang::whereKey($jenjang)->value('nama_jenjang') ?? ''
            : '';

        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $hasParameter = (bool) $this->selectedJenjang;

        $subjects = MataPelajaran::query()
            ->with('ms_jenjang')
            ->when($hasParameter, fn ($query) => $query->where('ms_jenjang_id', $this->selectedJenjang))
            ->when(!$hasParameter, fn ($query) => $query->whereRaw('1 = 0'))
            ->when($this->search, function ($query) {
                $query->where(function ($searchQuery) {
                    $searchQuery->where('nama_mapel', 'like', '%' . $this->search . '%')
                        ->orWhere('kode_mapel', 'like', '%' . $this->search . '%')
                        ->orWhere('deskripsi', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('urutan')
            ->orderBy('nama_mapel')
            ->paginate(12);

        return view('livewire.akademik.mata-pelajaran.index', [
            'subjects' => $subjects,
            'hasParameter' => $hasParameter,
        ]);
    }
}
