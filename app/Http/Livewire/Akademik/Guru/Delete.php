<?php

namespace App\Http\Livewire\Akademik\Guru;

use App\Http\Controllers\HelperController;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class Delete extends Component
{
    public $ms_pegawai_id;
    public $namaGuru = '';

    protected $listeners = ['confirmDeleteGuru' => 'setGuruId'];

    public function setGuruId($id)
    {
        $pegawai = $this->accessiblePegawais()->findOrFail($id);
        $this->ms_pegawai_id = $pegawai->ms_pegawai_id;
        $this->namaGuru = $pegawai->nama_pegawai;
    }

    public function deleteGuru()
    {
        abort_unless($this->ms_pegawai_id, 404);
        $pegawai = $this->accessiblePegawais()->findOrFail($this->ms_pegawai_id);

        if (Schema::hasTable('ms_penugasan_guru')) {
            $pegawaiIdColumn = Schema::hasColumn('ms_penugasan_guru', 'ms_pegawai_id')
                ? 'ms_pegawai_id'
                : (Schema::hasColumn('ms_penugasan_guru', 'ms_guru_id') ? 'ms_guru_id' : null);

            if ($pegawaiIdColumn) {
                $assignments = DB::table('ms_penugasan_guru')
                    ->where($pegawaiIdColumn, $pegawai->ms_pegawai_id);

                if (Schema::hasColumn('ms_penugasan_guru', 'deleted_at')) {
                    $assignments->whereNull('deleted_at');
                }

                if ($assignments->exists()) {
                    $this->dispatchBrowserEvent('alertify-error', [
                        'message' => 'Guru tidak dapat dihapus karena sudah digunakan pada penugasan.',
                    ]);

                    return;
                }
            }
        }

        $pegawai->delete();

        $this->dispatchBrowserEvent('hide-modal', ['modalId' => 'ModalDeleteGuru']);
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Data guru berhasil dihapus.',
        ]);
        $this->reset(['ms_pegawai_id', 'namaGuru']);
        $this->emit('refreshGurus');
    }

    private function accessiblePegawais()
    {
        $jenjangIds = auth()->user()->ms_jenjang()->pluck('ms_jenjang.ms_jenjang_id')->all();
        $guruJabatanIds = Jabatan::query()
            ->get()
            ->filter(fn (Jabatan $jabatan) => HelperController::mapRoleDariJabatan($jabatan->ms_jabatan_id) === 'GURU')
            ->modelKeys();

        return Pegawai::query()
            ->whereIn('ms_jenjang_id', $jenjangIds)
            ->where(function ($query) use ($guruJabatanIds) {
                $query->where('jenis_pegawai', 'GURU');

                if ($guruJabatanIds) {
                    $query->orWhereIn('ms_jabatan_id', $guruJabatanIds);
                }
            });
    }

    public function render()
    {
        return view('livewire.akademik.guru.delete');
    }
}
