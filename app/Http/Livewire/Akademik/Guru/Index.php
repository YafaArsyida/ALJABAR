<?php

namespace App\Http\Livewire\Akademik\Guru;

use App\Http\Controllers\HelperController;
use App\Models\Jabatan;
use App\Models\Jenjang;
use App\Models\Pegawai;
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
        'refreshGurus' => '$refresh',
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
        $allowedJenjangIds = auth()->user()->ms_jenjang()
            ->pluck('ms_jenjang.ms_jenjang_id')
            ->all();

        $guruJabatanIds = Jabatan::query()
            ->get()
            ->filter(fn (Jabatan $jabatan) => HelperController::mapRoleDariJabatan($jabatan->ms_jabatan_id) === 'GURU')
            ->modelKeys();

        $hasParameter = $this->selectedJenjang
            && in_array((int) $this->selectedJenjang, array_map('intval', $allowedJenjangIds), true);

        $pegawais = Pegawai::query()
            ->with(['ms_jabatan', 'ms_jenjang', 'akun_pengguna'])
            ->whereIn('ms_jenjang_id', $allowedJenjangIds)
            ->where(function ($query) use ($guruJabatanIds) {
                $query->where('jenis_pegawai', 'GURU');

                if ($guruJabatanIds) {
                    $query->orWhereIn('ms_jabatan_id', $guruJabatanIds);
                }
            })
            ->when($hasParameter, fn ($query) => $query->where('ms_jenjang_id', $this->selectedJenjang))
            ->when(!$hasParameter, fn ($query) => $query->whereRaw('1 = 0'))
            ->when($this->search, function ($query) {
                $query->where(function ($searchQuery) {
                    $searchQuery->where('nama_pegawai', 'like', '%' . $this->search . '%')
                        ->orWhere('nip', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('nama_pegawai')
            ->paginate(12);

        return view('livewire.akademik.guru.index', [
            'pegawais' => $pegawais,
            'hasParameter' => $hasParameter,
        ]);
    }
}
