<?php

namespace App\Http\Livewire\Akademik\MataPelajaran;

use App\Models\MataPelajaran;
use App\Models\PenugasanGuru;
use Livewire\Component;

class Delete extends Component
{
    public $mataPelajaranId;
    public $namaMapel = '';

    protected $listeners = [
        'confirmDeleteMataPelajaran' => 'setMataPelajaranId',
    ];

    public function setMataPelajaranId($id)
    {
        $subject = MataPelajaran::findOrFail($id);
        $this->mataPelajaranId = $subject->ms_mata_pelajaran_id;
        $this->namaMapel = $subject->nama_mapel;
    }

    public function deleteMataPelajaran()
    {
        abort_unless($this->mataPelajaranId, 404);

        $subject = MataPelajaran::findOrFail($this->mataPelajaranId);

        if (PenugasanGuru::where('ms_mata_pelajaran_id', $subject->ms_mata_pelajaran_id)->exists()) {
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Mata pelajaran tidak dapat dihapus karena sudah digunakan pada penugasan guru.',
            ]);

            return;
        }

        $subject->delete();

        $this->dispatchBrowserEvent('hide-modal', ['modalId' => 'ModalDeleteMataPelajaran']);
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Mata pelajaran berhasil dihapus.',
        ]);
        $this->reset(['mataPelajaranId', 'namaMapel']);
        $this->emit('refreshMataPelajarans');
    }

    public function render()
    {
        return view('livewire.akademik.mata-pelajaran.delete');
    }
}
