<?php

namespace App\Http\Livewire\PPDB\Periode;

use App\Models\PPDBPeriode;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Create extends Component
{
    public $nama_periode = '';

    public $ms_jenjang_id;

    public $tanggal_mulai = '';

    public $tanggal_selesai = '';

    public $tautan_grup = '';

    public $status = 'aktif';

    public $deskripsi = '';

    protected $listeners = [
        'showCreatePeriode',
    ];

    /**
     * Menyiapkan form tambah periode.
     */
    public function showCreatePeriode($jenjang)
    {
        $this->resetValidation();
        $this->resetInput();

        $this->ms_jenjang_id = $jenjang;
    }

    /**
     * Aturan validasi form.
     */
    protected function rules()
    {
        return [
            'nama_periode' => 'required|string|max:255',
            'ms_jenjang_id' => 'required|exists:ms_jenjang,ms_jenjang_id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tautan_grup' => 'nullable|url|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'deskripsi' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Pesan validasi dalam bahasa Indonesia.
     */
    protected $messages = [
        'nama_periode.required' => 'Nama periode tidak boleh kosong.',
        'nama_periode.max' => 'Nama periode maksimal 255 karakter.',
        'ms_jenjang_id.required' => 'Jenjang belum dipilih.',
        'ms_jenjang_id.exists' => 'Jenjang yang dipilih tidak valid.',
        'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
        'tanggal_mulai.date' => 'Tanggal mulai tidak valid.',
        'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
        'tanggal_selesai.date' => 'Tanggal selesai tidak valid.',
        'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus sama dengan atau setelah tanggal mulai.',
        'tautan_grup.url' => 'Tautan grup harus berupa URL yang valid.',
        'tautan_grup.max' => 'Tautan grup maksimal 2048 karakter.',
        'status.required' => 'Status periode wajib dipilih.',
        'status.in' => 'Status periode tidak valid.',
        'deskripsi.max' => 'Deskripsi maksimal 1000 karakter.',
    ];

    /**
     * Validasi input saat diperbarui.
     */
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    /**
     * Simpan periode PPDB.
     */
    public function save()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            PPDBPeriode::create([
                'nama_periode' => $this->nama_periode,
                'ms_jenjang_id' => $this->ms_jenjang_id,
                'tanggal_mulai' => $this->tanggal_mulai,
                'tanggal_selesai' => $this->tanggal_selesai,
                'tautan_grup' => $this->tautan_grup ?: null,
                'status' => $this->status,
                'deskripsi' => $this->deskripsi,
            ]);

            DB::commit();

            $this->dispatchBrowserEvent('alertify-success', [
                'message' => 'Periode SPMB berhasil ditambahkan.',
            ]);

            $this->dispatchBrowserEvent('hide-modal', [
                'modalId' => 'ModalAddPeriode',
            ]);

            $this->resetInput();

            $this->emit('refreshPeriodes');
        } catch (ValidationException $e) {
            DB::rollBack();

            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Validasi gagal. Periksa kembali input.',
            ]);

            throw $e;
        } catch (\Throwable $e) {
            DB::rollBack();

            report($e);

            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Periode SPMB gagal disimpan. Silakan coba kembali.',
            ]);
        }
    }

    /**
     * Reset seluruh input form.
     */
    public function resetInput()
    {
        $this->nama_periode = '';
        $this->ms_jenjang_id = null;
        $this->tanggal_mulai = '';
        $this->tanggal_selesai = '';
        $this->tautan_grup = '';
        $this->status = 'aktif';
        $this->deskripsi = '';
    }
    public function render()
    {
        return view('livewire.p-p-d-b.periode.create');
    }
}
