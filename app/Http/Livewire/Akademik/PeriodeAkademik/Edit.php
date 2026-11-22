<?php

namespace App\Http\Livewire\Akademik\PeriodeAkademik;

use App\Models\Jenjang;
use App\Models\PeriodeAkademik;
use App\Models\TahunAjar;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public $periodeId;
    public $ms_jenjang_id;
    public $ms_tahun_ajar_id;
    public $nama_periode = 'Semester 1';
    public $tanggal_mulai = '';
    public $tanggal_selesai = '';
    public $urutan = 1;
    public $status = 'AKTIF';
    public $deskripsi = '';

    protected $listeners = ['loadDataPeriodeAkademik'];

    public function loadDataPeriodeAkademik($id)
    {
        $periode = PeriodeAkademik::findOrFail($id);

        $this->resetValidation();
        $this->periodeId = $periode->ms_periode_akademik_id;
        $this->ms_jenjang_id = $periode->ms_jenjang_id;
        $this->ms_tahun_ajar_id = $periode->ms_tahun_ajar_id;
        $this->nama_periode = $periode->nama_periode;
        $this->tanggal_mulai = $periode->tanggal_mulai->format('Y-m-d');
        $this->tanggal_selesai = optional($periode->tanggal_selesai)->format('Y-m-d') ?? '';
        $this->urutan = $periode->urutan;
        $this->status = $periode->status;
        $this->deskripsi = $periode->deskripsi ?? '';
    }

    protected function rules(PeriodeAkademik $periode): array
    {
        return [
            'nama_periode' => [
                'required',
                'string',
                'max:100',
                Rule::in(['Semester 1', 'Semester 2']),
                Rule::unique('ms_periode_akademik', 'nama_periode')
                    ->where('ms_jenjang_id', $periode->ms_jenjang_id)
                    ->where('ms_tahun_ajar_id', $periode->ms_tahun_ajar_id)
                    ->whereNull('deleted_at')
                    ->ignore($periode->ms_periode_akademik_id, 'ms_periode_akademik_id'),
            ],
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => ['required', Rule::in(['AKTIF', 'NONAKTIF'])],
            'deskripsi' => 'nullable|string|max:1000',
        ];
    }

    protected $messages = [
        'nama_periode.required' => 'Pilih semester.',
        'nama_periode.in' => 'Semester yang dipilih tidak valid.',
        'nama_periode.unique' => 'Semester tersebut sudah terdaftar untuk jenjang dan tahun ajar ini.',
        'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
        'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
        'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai.',
    ];

    public function updatePeriodeAkademik()
    {
        abort_unless($this->periodeId, 404);
        $periode = PeriodeAkademik::findOrFail($this->periodeId);
        $this->urutan = $this->nama_periode === 'Semester 2' ? 2 : 1;
        $validated = $this->validate($this->rules($periode));

        $periode->update([
            'nama_periode' => $validated['nama_periode'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'urutan' => $this->urutan,
            'status' => $validated['status'],
            'deskripsi' => $validated['deskripsi'] ?? null,
        ]);

        $this->dispatchBrowserEvent('hide-modal', ['modalId' => 'ModalEditPeriodeAkademik']);
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Periode akademik berhasil diperbarui.',
        ]);
        $this->emit('refreshPeriodeAkademiks');
    }

    public function render()
    {
        return view('livewire.akademik.periode-akademik.edit', [
            'jenjang' => $this->ms_jenjang_id ? Jenjang::find($this->ms_jenjang_id) : null,
            'tahunAjar' => $this->ms_tahun_ajar_id ? TahunAjar::find($this->ms_tahun_ajar_id) : null,
        ]);
    }
}
