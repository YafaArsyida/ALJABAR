<?php

namespace App\Http\Livewire\PPDB\Admin\Laporan;

use App\Models\PPDBJalur;
use App\Models\Jenjang;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PPDBPeriode;
use App\Models\PPDBPendaftaran;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $selectedJenjang = null;
    public $selectedPeriode = null;

    public $search = '';
    public $filterJalur = '';

    protected $listeners = [
        'dashboardParametersUpdated' => 'updateParameters',
        'pendaftaranTersimpan' => '$refresh',
        'pendaftaranDiperbarui' => '$refresh',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updateParameters($jenjangId = null, $periodeId = null)
    {
        $jenjang = Jenjang::query()
            ->whereKey($jenjangId)
            ->where('status', 'Aktif')
            ->whereHas('ms_pengguna', function ($query) {
                $query->whereKey(Auth::id());
            })
            ->first();

        $this->selectedJenjang = $jenjang?->ms_jenjang_id;
        $this->selectedPeriode = $this->selectedJenjang && $periodeId
            ? PPDBPeriode::query()
                ->forAuthorizedJenjang(Auth::id())
                ->whereKey($periodeId)
                ->where('ms_jenjang_id', $this->selectedJenjang)
                ->value('ppdb_periode_id')
            : null;

        $this->filterJalur = '';
        $this->resetPage();
    }

    /**
     * Reset pagination saat pencarian berubah.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterJalur()
    {
        $this->resetPage();
    }

    /**
     * Menghapus pencarian.
     */
    public function resetFilter()
    {
        $this->reset('search');

        $this->resetPage();
    }

    public function unduhLaporan()
    {
        if (! $this->selectedJenjang || ! $this->selectedPeriode) {
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Pilih jenjang dan periode terlebih dahulu.',
            ]);

            return;
        }

        if (! $this->periodeTerpilihTersedia()) {
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Periode SPMB tidak tersedia untuk pilihan tersebut.',
            ]);

            return;
        }

        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Laporan PDF sedang disiapkan.',
        ]);

        $url = route('ppdb.admin.laporan.pdf', [
            'jenjang' => $this->selectedJenjang,
            'periode' => $this->selectedPeriode,
            'jalur' => $this->filterJalur,
            'search' => $this->search,
        ]);

        $this->emit('openNewTab', $url);
    }

    protected function periodeTerpilihTersedia(): bool
    {
        return PPDBPeriode::query()
            ->forAuthorizedJenjang(Auth::id())
            ->whereKey($this->selectedPeriode)
            ->where('ms_jenjang_id', $this->selectedJenjang)
            ->exists();
    }

    public function render()
    {
        $periode = null;

        $daftarJalur = collect();

        if ($this->selectedJenjang && $this->selectedPeriode) {
            $periode = PPDBPeriode::query()
                ->forAuthorizedJenjang(Auth::id())
                ->whereKey($this->selectedPeriode)
                ->where('ms_jenjang_id', $this->selectedJenjang)
                ->first();

            if ($periode) {
                $daftarJalurQuery = PPDBJalur::query()
                    ->where(
                        'ppdb_periode_id',
                        $periode->ppdb_periode_id
                    );

                if ($periode->status === 'aktif') {
                    $daftarJalurQuery->where('status', 'aktif');
                }

                $daftarJalur = $daftarJalurQuery
                    ->orderBy('nama_jalur')
                    ->get();
            }
        }

        // Query utama laporan.
        $query = PPDBPendaftaran::query()
            ->with([
                'ppdb_calon_siswa',
                'ppdb_orangtua',
                'ppdb_jalur',
            ])
            ->withCount('ppdb_berkas')
            ->where('status', 'diterima');

        // Batasi laporan ke periode terpilih.
        if ($periode) {
            $query->where(
                'ppdb_periode_id',
                $periode->ppdb_periode_id
            );
        } else {
            // Jangan tampilkan data jika pasangan parameter tidak valid.
            $query->whereRaw('1 = 0');
        }

        // Cari berdasarkan nomor pendaftaran
        // atau nama calon siswa.
        $query->when(
            trim($this->search) !== '',
            function ($query) {
                $search = trim($this->search);

                $query->where(function ($query) use ($search) {
                    $query->where(
                        'nomor_pendaftaran',
                        'like',
                        '%' . $search . '%'
                    );

                    $query->orWhereHas(
                        'ppdb_calon_siswa',
                        function ($query) use ($search) {
                            $query->where(
                                'nama_siswa',
                                'like',
                                '%' . $search . '%'
                            );
                        }
                    );
                });
            }
        );

        $query->when(
            $this->filterJalur !== '',
            function ($query) {
                $query->where(
                    'ppdb_jalur_id',
                    $this->filterJalur
                );
            }
        );

        // Urutkan berdasarkan pendaftaran terbaru.
        $pendaftar = $query
            ->latest('created_at')
            ->paginate(50);

        return view('livewire.p-p-d-b.admin.laporan.index',[
            'periode' => $periode,
            'pendaftar' => $pendaftar,
            'daftarJalur' => $daftarJalur,
        ]);
    }
}
