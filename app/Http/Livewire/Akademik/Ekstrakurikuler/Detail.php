<?php

namespace App\Http\Livewire\Akademik\Ekstrakurikuler;

use App\Models\Ekstrakurikuler;
use Livewire\Component;

class Detail extends Component
{
    public $ms_ekstrakurikuler_id;

    protected $listeners = [
        'detailEkstrakurikuler',
        'cetakEkstrakurikuler',
    ];

    public function detailEkstrakurikuler($ms_ekstrakurikuler_id)
    {
        $this->ms_ekstrakurikuler_id = $ms_ekstrakurikuler_id;
    }

    public function cetakEkstrakurikuler()
    {
        if (!$this->ms_ekstrakurikuler_id) {
            $this->dispatchBrowserEvent('alertify-error', ['message' => 'Ekstrakurikuler tidak diketahui.']);
            return;
        }

        $this->dispatchBrowserEvent('alertify-success', ['message' => 'Laporan diproses.']);

        $url = route('akademik.ekstrakurikuler-siswa.pdf', [
            'ekstrakurikuler_id' => $this->ms_ekstrakurikuler_id,
        ]);

        $this->emit('openNewTab', $url);
    }

    public function render()
    {
        $ekstrakurikuler = null;

        if ($this->ms_ekstrakurikuler_id) {
            $ekstrakurikuler = Ekstrakurikuler::with([
                'ms_jenjang',
                'ms_tahun_ajar',
            ])
                ->withCount([
                    'ms_penempatan_ekstrakurikuler as total_peserta',
                ])
                ->find($this->ms_ekstrakurikuler_id);
        }
        return view('livewire.akademik.ekstrakurikuler.detail', [
            'ekstrakurikuler' => $ekstrakurikuler,
        ]);
    }
}
