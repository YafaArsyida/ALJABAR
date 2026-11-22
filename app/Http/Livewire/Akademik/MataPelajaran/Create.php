<?php

namespace App\Http\Livewire\Akademik\MataPelajaran;

use App\Models\Jenjang;
use App\Models\MataPelajaran;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public $nama_mapel = '';
    public $kode_mapel = '';
    public $ms_jenjang_id;
    public $urutan = 1;
    public $status = 'AKTIF';
    public $deskripsi = '';

    protected $listeners = ['showCreateMataPelajaran'];

    protected $messages = [
        'nama_mapel.required' => 'Nama mata pelajaran wajib diisi.',
        'nama_mapel.unique' => 'Nama mata pelajaran sudah terdaftar pada jenjang ini.',
        'kode_mapel.unique' => 'Kode mata pelajaran sudah digunakan pada jenjang ini.',
        'ms_jenjang_id.required' => 'Pilih jenjang terlebih dahulu.',
        'ms_jenjang_id.exists' => 'Jenjang yang dipilih tidak ditemukan.',
        'urutan.required' => 'Urutan wajib diisi.',
        'urutan.integer' => 'Urutan harus berupa angka.',
        'urutan.min' => 'Urutan minimal 1.',
    ];

    public function showCreateMataPelajaran($jenjang)
    {
        $this->resetValidation();
        $this->resetForm();
        $this->ms_jenjang_id = $jenjang;
    }

    protected function rules(): array
    {
        return [
            'nama_mapel' => [
                'required',
                'string',
                'max:100',
                Rule::unique('ms_mata_pelajaran', 'nama_mapel')
                    ->where('ms_jenjang_id', $this->ms_jenjang_id)
                    ->whereNull('deleted_at'),
            ],
            'kode_mapel' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('ms_mata_pelajaran', 'kode_mapel')
                    ->where('ms_jenjang_id', $this->ms_jenjang_id)
                    ->whereNull('deleted_at'),
            ],
            'ms_jenjang_id' => [
                'required',
                Rule::exists('ms_jenjang', 'ms_jenjang_id')->whereNull('deleted_at'),
            ],
            'urutan' => 'required|integer|min:1',
            'status' => ['required', Rule::in(['AKTIF', 'NONAKTIF'])],
            'deskripsi' => 'nullable|string|max:1000',
        ];
    }

    public function save()
    {
        $this->kode_mapel = trim((string) $this->kode_mapel) ?: null;
        $validated = $this->validate();

        MataPelajaran::create($validated);

        $this->dispatchBrowserEvent('hide-modal', ['modalId' => 'ModalAddMataPelajaran']);
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Mata pelajaran berhasil ditambahkan.',
        ]);
        $this->emit('refreshMataPelajarans');
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset(['nama_mapel', 'kode_mapel', 'deskripsi']);
        $this->urutan = 1;
        $this->status = 'AKTIF';
    }

    public function render()
    {
        return view('livewire.akademik.mata-pelajaran.create', [
            'jenjang' => $this->ms_jenjang_id ? Jenjang::find($this->ms_jenjang_id) : null,
        ]);
    }
}
