<?php

namespace App\Http\Livewire\PPDB\Parameter;

use App\Models\Jenjang as JenjangModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Jenjang extends Component
{
    public $selectedJenjang = null;

    public function mount()
    {
        $jenjang = $this->jenjangTersedia()->first();
        $this->selectedJenjang = $jenjang->ms_jenjang_id ?? null;
    }

    public function updatedSelectedJenjang()
    {
        $this->emit('parameterUpdated', $this->selectedJenjang);
    }

    public function render()
    {
        return view('livewire.p-p-d-b.parameter.jenjang', [
            'select_jenjang' => $this->jenjangTersedia()->get(),
        ]);
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
            ->orderBy('nama_jenjang');
    }
}
