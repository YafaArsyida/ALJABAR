<?php

namespace App\Http\Livewire\Akademik\PeriodeAkademik;

use App\Models\PeriodeAkademik;
use Livewire\Component;

class Delete extends Component
{
    public $periodeId;
    public $namaPeriode = '';

    protected $listeners = [
        'confirmDeletePeriodeAkademik' => 'setPeriodeId',
    ];

    public function setPeriodeId($id)
    {
        $periode = PeriodeAkademik::findOrFail($id);
        $this->periodeId = $periode->ms_periode_akademik_id;
        $this->namaPeriode = $periode->nama_periode;
    }

    public function deletePeriodeAkademik()
    {
        abort_unless($this->periodeId, 404);

        $periode = PeriodeAkademik::findOrFail($this->periodeId);

        if ($periode->ms_penugasan_guru()->exists()) {
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Periode tidak dapat dihapus karena sudah digunakan pada penugasan guru.',
            ]);

            return;
        }

        $periode->delete();

        $this->dispatchBrowserEvent('hide-modal', ['modalId' => 'ModalDeletePeriodeAkademik']);
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Periode akademik berhasil dihapus.',
        ]);
        $this->reset(['periodeId', 'namaPeriode']);
        $this->emit('refreshPeriodeAkademiks');
    }

    public function render()
    {
        return view('livewire.akademik.periode-akademik.delete');
    }
}
