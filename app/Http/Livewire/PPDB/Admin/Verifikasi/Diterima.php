<?php

namespace App\Http\Livewire\PPDB\Admin\Verifikasi;

use App\Models\PPDBPendaftaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Diterima extends Component
{
    public $pendaftaranId = null;

    protected $listeners = [
        'bukaDiterima' => 'bukaDiterima',
    ];

    /**
     * Menerima event dari Livewire Detail.
     */
    public function bukaDiterima($id)
    {
        $this->pendaftaranId = $id;

        $pendaftaran = $this->pendaftaranDapatDiproses($id);

        if (
            !$pendaftaran ||
            !in_array($pendaftaran->status, ['pengecekan', 'perbaikan'])
        ) {
            $this->reset(['pendaftaranId']);

            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Data pendataan tidak tersedia untuk diterima.',
            ]);

            return;
        }
    }

    /**
     * Memproses penerimaan pendaftaran.
     */
    public function terimaPendaftaran()
    {
        $this->validate([
            'pendaftaranId' => ['required', 'integer'],
        ], [
            'pendaftaranId.required' =>
                'Data pendataan belum dipilih.',
            'pendaftaranId.integer' =>
                'ID pendataan tidak valid.',
        ]);

        $pendaftaran = $this->pendaftaranDapatDiproses(
            $this->pendaftaranId
        );

        if (
            !$pendaftaran ||
            !in_array($pendaftaran->status, ['pengecekan', 'perbaikan'])
        ) {
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Status pendataan sudah berubah atau data tidak ditemukan.',
            ]);

            return;
        }

        $pendaftaran->update([
            'status' => 'diterima',
            'catatan_perbaikan' => null,
            'current_step' => 8,

            'submitted_by' => auth()->user()->ms_pengguna_id,
            'submitted_at' => now(),
        ]);

        $this->dispatchBrowserEvent('hide-modal', [
            'modalId' => 'ModalKonfirmasiDiterima',
        ]);

        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Calon siswa berhasil diterima.',
        ]);

        $this->reset([
            'pendaftaranId',
        ]);

        $this->resetValidation();

        $this->emit('pendaftaranDiperbarui');
    }

    public function render()
    {
        return view('livewire.p-p-d-b.admin.verifikasi.diterima');
    }

    private function pendaftaranDapatDiproses($id): ?PPDBPendaftaran
    {
        return PPDBPendaftaran::query()
            ->whereKey($id)
            ->whereHas('ppdb_periode', function ($query) {
                $query->forAuthorizedJenjang(Auth::id())
                    ->where('status', 'aktif');
            })
            ->first();
    }
}
