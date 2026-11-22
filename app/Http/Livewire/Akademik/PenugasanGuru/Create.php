<?php

namespace App\Http\Livewire\Akademik\PenugasanGuru;

use App\Models\PenugasanGuru;
use App\Http\Livewire\Akademik\PenugasanGuru\Concerns\InteractsWithPenugasanGuru;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithPenugasanGuru;

    public $selectedJenjang = null;
    public $selectedTahunAjar = null;
    public $ms_pegawai_id = '';
    public $ms_kelas_id = '';
    public $ms_mata_pelajaran_id = '';
    public $ms_periode_akademik_id = '';
    public $status = 'AKTIF';
    public $deskripsi = '';

    protected $listeners = ['showCreatePenugasanGuru'];

    protected $messages = [
        'ms_pegawai_id.required' => 'Pilih guru pengampu.',
        'ms_kelas_id.required' => 'Pilih kelas.',
        'ms_mata_pelajaran_id.required' => 'Pilih mata pelajaran.',
        'ms_periode_akademik_id.required' => 'Pilih periode akademik.',
        'status.in' => 'Status penugasan tidak valid.',
    ];

    public function showCreatePenugasanGuru($jenjang, $tahunAjar)
    {
        $this->resetValidation();
        $this->resetForm();
        $this->selectedJenjang = $jenjang;
        $this->selectedTahunAjar = $tahunAjar;
    }

    protected function rules(): array
    {
        return [
            'ms_pegawai_id' => ['required', 'integer', Rule::exists('ms_pegawai', 'ms_pegawai_id')->whereNull('deleted_at')],
            'ms_kelas_id' => ['required', 'integer', Rule::exists('ms_kelas', 'ms_kelas_id')->whereNull('deleted_at')],
            'ms_mata_pelajaran_id' => ['required', 'integer', Rule::exists('ms_mata_pelajaran', 'ms_mata_pelajaran_id')->whereNull('deleted_at')],
            'ms_periode_akademik_id' => ['required', 'integer', Rule::exists('ms_periode_akademik', 'ms_periode_akademik_id')->whereNull('deleted_at')],
            'status' => ['required', Rule::in(['AKTIF', 'NONAKTIF'])],
            'deskripsi' => 'nullable|string|max:1000',
        ];
    }

    public function save()
    {
        $validated = $this->validate();
        $this->assertEligibleSelections($validated, $this->selectedJenjang, $this->selectedTahunAjar);

        $existing = PenugasanGuru::withTrashed()
            ->where('ms_pegawai_id', $validated['ms_pegawai_id'])
            ->where('ms_kelas_id', $validated['ms_kelas_id'])
            ->where('ms_mata_pelajaran_id', $validated['ms_mata_pelajaran_id'])
            ->where('ms_periode_akademik_id', $validated['ms_periode_akademik_id'])
            ->first();

        if ($existing && !$existing->trashed()) {
            throw ValidationException::withMessages([
                'ms_periode_akademik_id' => 'Penugasan untuk guru, kelas, mata pelajaran, dan periode ini sudah ada.',
            ]);
        }

        if ($existing) {
            $existing->restore();
            $existing->update($validated);
        } else {
            PenugasanGuru::create($validated);
        }

        $this->dispatchBrowserEvent('hide-modal', ['modalId' => 'ModalAddPenugasanGuru']);
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Penugasan guru berhasil ditambahkan.',
        ]);
        $this->emit('refreshPenugasanGurus');
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset([
            'ms_pegawai_id',
            'ms_kelas_id',
            'ms_mata_pelajaran_id',
            'ms_periode_akademik_id',
            'deskripsi',
        ]);
        $this->status = 'AKTIF';
    }

    public function render()
    {
        $contextIsValid = $this->hasValidContext($this->selectedJenjang, $this->selectedTahunAjar);

        return view('livewire.akademik.penugasan-guru.create', [
            'teachers' => $contextIsValid ? $this->teacherOptions($this->selectedJenjang)->get() : collect(),
            'classes' => $contextIsValid ? $this->classOptions($this->selectedJenjang, $this->selectedTahunAjar)->get() : collect(),
            'subjects' => $contextIsValid ? $this->subjectOptions($this->selectedJenjang)->get() : collect(),
            'periods' => $contextIsValid ? $this->periodOptions($this->selectedJenjang, $this->selectedTahunAjar)->get() : collect(),
            'contextIsValid' => $contextIsValid,
        ]);
    }
}
