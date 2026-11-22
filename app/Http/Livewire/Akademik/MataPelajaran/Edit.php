<?php

namespace App\Http\Livewire\Akademik\MataPelajaran;

use App\Models\Jenjang;
use App\Models\MataPelajaran;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public $mataPelajaranId;
    public $ms_jenjang_id;
    public $nama_mapel = '';
    public $kode_mapel = '';
    public $urutan = 1;
    public $status = 'AKTIF';
    public $deskripsi = '';

    protected $listeners = ['loadDataMataPelajaran'];

    protected $messages = [
        'nama_mapel.required' => 'Nama mata pelajaran wajib diisi.',
        'nama_mapel.unique' => 'Nama mata pelajaran sudah terdaftar pada jenjang ini.',
        'kode_mapel.unique' => 'Kode mata pelajaran sudah digunakan pada jenjang ini.',
        'urutan.required' => 'Urutan wajib diisi.',
        'urutan.integer' => 'Urutan harus berupa angka.',
        'urutan.min' => 'Urutan minimal 1.',
    ];

    public function loadDataMataPelajaran($id)
    {
        $subject = MataPelajaran::findOrFail($id);

        $this->resetValidation();
        $this->mataPelajaranId = $subject->ms_mata_pelajaran_id;
        $this->ms_jenjang_id = $subject->ms_jenjang_id;
        $this->nama_mapel = $subject->nama_mapel;
        $this->kode_mapel = $subject->kode_mapel ?? '';
        $this->urutan = $subject->urutan;
        $this->status = $subject->status;
        $this->deskripsi = $subject->deskripsi ?? '';
    }

    protected function rules(MataPelajaran $subject): array
    {
        return [
            'nama_mapel' => [
                'required',
                'string',
                'max:100',
                Rule::unique('ms_mata_pelajaran', 'nama_mapel')
                    ->where('ms_jenjang_id', $subject->ms_jenjang_id)
                    ->whereNull('deleted_at')
                    ->ignore($subject->ms_mata_pelajaran_id, 'ms_mata_pelajaran_id'),
            ],
            'kode_mapel' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('ms_mata_pelajaran', 'kode_mapel')
                    ->where('ms_jenjang_id', $subject->ms_jenjang_id)
                    ->whereNull('deleted_at')
                    ->ignore($subject->ms_mata_pelajaran_id, 'ms_mata_pelajaran_id'),
            ],
            'urutan' => 'required|integer|min:1',
            'status' => ['required', Rule::in(['AKTIF', 'NONAKTIF'])],
            'deskripsi' => 'nullable|string|max:1000',
        ];
    }

    public function updateMataPelajaran()
    {
        abort_unless($this->mataPelajaranId, 404);
        $subject = MataPelajaran::findOrFail($this->mataPelajaranId);
        $this->kode_mapel = trim((string) $this->kode_mapel) ?: null;
        $validated = $this->validate($this->rules($subject));

        $subject->update($validated);

        $this->dispatchBrowserEvent('hide-modal', ['modalId' => 'ModalEditMataPelajaran']);
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Mata pelajaran berhasil diperbarui.',
        ]);
        $this->emit('refreshMataPelajarans');
    }

    public function render()
    {
        return view('livewire.akademik.mata-pelajaran.edit', [
            'jenjang' => $this->ms_jenjang_id ? Jenjang::find($this->ms_jenjang_id) : null,
        ]);
    }
}
