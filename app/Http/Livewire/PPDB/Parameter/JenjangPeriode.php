<?php

namespace App\Http\Livewire\PPDB\Parameter;

use App\Models\Jenjang as JenjangModel;
use App\Models\PPDBPeriode;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class JenjangPeriode extends Component
{
    public $selectedJenjang = null;
    public $selectedPeriode = null;

    public function mount()
    {
        $jenjang = $this->jenjangTersedia()->first();
        $this->selectedJenjang = $jenjang->ms_jenjang_id ?? null;
        $this->pilihPeriodeAktif();
    }

    public function updatedSelectedJenjang()
    {
        if (! $this->selectedJenjang || ! $this->jenjangTersedia()
            ->whereKey($this->selectedJenjang)
            ->exists()) {
            $this->selectedJenjang = null;
        }

        $this->pilihPeriodeAktif();
        $this->emitParameters();
    }

    public function updatedSelectedPeriode()
    {
        $this->selectedPeriode = $this->selectedJenjang && $this->selectedPeriode
            ? $this->periodeTersedia()
                ->whereKey($this->selectedPeriode)
                ->value('ppdb_periode_id')
            : null;

        $this->emitParameters();
    }

    public function render()
    {
        return view('livewire.p-p-d-b.parameter.jenjang-periode', [
            'select_jenjang' => $this->jenjangTersedia()->get(),
            'select_periode' => $this->periodeTersedia()
                ->orderByDesc('tanggal_mulai')
                ->orderByDesc('ppdb_periode_id')
                ->get(),
        ]);
    }

    private function pilihPeriodeAktif(): void
    {
        $this->selectedPeriode = $this->periodeTersedia()
            ->where('status', 'aktif')
            ->orderByDesc('tanggal_mulai')
            ->orderByDesc('ppdb_periode_id')
            ->value('ppdb_periode_id');
    }

    private function emitParameters(): void
    {
        $this->emit(
            'dashboardParametersUpdated',
            $this->selectedJenjang,
            $this->selectedPeriode
        );
    }

    private function periodeTersedia()
    {
        return PPDBPeriode::query()
            ->forAuthorizedJenjang(Auth::id())
            ->where('ms_jenjang_id', $this->selectedJenjang);
    }

    private function jenjangTersedia()
    {
        return JenjangModel::query()
            ->whereIn('ms_jenjang_id', function ($query) {
                $query->select('ms_jenjang_id')
                    ->from('ms_akses_jenjang')
                    ->where('ms_pengguna_id', Auth::id());
            })
            ->where('status', 'Aktif')
            ->orderBy('ms_jenjang_id');
    }
}
