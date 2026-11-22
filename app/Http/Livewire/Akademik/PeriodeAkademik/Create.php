<?php

namespace App\Http\Livewire\Akademik\PeriodeAkademik;

use App\Models\Jenjang;
use App\Models\PeriodeAkademik;
use App\Models\TahunAjar;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public $nama_periode = 'Semester 1';
    public $ms_jenjang_id;
    public $ms_tahun_ajar_id;
    public $tanggal_mulai = '';
    public $tanggal_selesai = '';
    public $urutan = 1;
    public $status = 'AKTIF';
    public $deskripsi = '';

    protected $listeners = ['showCreatePeriodeAkademik'];

    public function showCreatePeriodeAkademik($jenjang, $tahunAjar)
    {
        $this->resetValidation();
        $this->resetForm();
        $this->ms_jenjang_id = $jenjang;
        $this->ms_tahun_ajar_id = $tahunAjar;
    }

    protected function rules(): array
    {
        return [
            'nama_periode' => [
                'required',
                'string',
                'max:100',
                Rule::in(['Semester 1', 'Semester 2']),
                Rule::unique('ms_periode_akademik', 'nama_periode')
                    ->where('ms_jenjang_id', $this->ms_jenjang_id)
                    ->where('ms_tahun_ajar_id', $this->ms_tahun_ajar_id)
                    ->whereNull('deleted_at'),
            ],
            'ms_jenjang_id' => [
                'required',
                Rule::exists('ms_jenjang', 'ms_jenjang_id')->whereNull('deleted_at'),
            ],
            'ms_tahun_ajar_id' => [
                'required',
                Rule::exists('ms_tahun_ajar', 'ms_tahun_ajar_id')->whereNull('deleted_at'),
            ],
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'urutan' => 'required|integer|min:1',
            'status' => ['required', Rule::in(['AKTIF', 'NONAKTIF'])],
            'deskripsi' => 'nullable|string|max:1000',
        ];
    }

    protected $messages = [
        'nama_periode.required' => 'Pilih semester.',
        'nama_periode.in' => 'Semester yang dipilih tidak valid.',
        'nama_periode.unique' => 'Semester tersebut sudah terdaftar untuk jenjang dan tahun ajar ini.',
        'ms_jenjang_id.required' => 'Jenjang belum dipilih.',
        'ms_jenjang_id.exists' => 'Jenjang yang dipilih tidak ditemukan.',
        'ms_tahun_ajar_id.required' => 'Tahun ajar belum dipilih.',
        'ms_tahun_ajar_id.exists' => 'Tahun ajar yang dipilih tidak ditemukan.',
        'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
        'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
        'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai.',
        'urutan.required' => 'Urutan wajib diisi.',
        'urutan.integer' => 'Urutan harus berupa angka.',
        'urutan.min' => 'Urutan minimal 1.',
    ];

    public function save()
    {
        $this->urutan = $this->nama_periode === 'Semester 2' ? 2 : 1;
        $validated = $this->validate();

        PeriodeAkademik::create($validated);

        $this->dispatchBrowserEvent('hide-modal', ['modalId' => 'ModalAddPeriodeAkademik']);
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Periode akademik berhasil ditambahkan.',
        ]);
        $this->emit('refreshPeriodeAkademiks');
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset(['tanggal_mulai', 'tanggal_selesai', 'deskripsi']);
        $this->nama_periode = 'Semester 1';
        $this->urutan = 1;
        $this->status = 'AKTIF';
    }

    public function render()
    {
        return view('livewire.akademik.periode-akademik.create', [
            'jenjang' => $this->ms_jenjang_id ? Jenjang::find($this->ms_jenjang_id) : null,
            'tahunAjar' => $this->ms_tahun_ajar_id ? TahunAjar::find($this->ms_tahun_ajar_id) : null,
        ]);
    }
}
