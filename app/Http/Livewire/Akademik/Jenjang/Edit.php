<?php

namespace App\Http\Livewire\Akademik\Jenjang;

use Livewire\Component;
use App\Models\Jenjang as JenjangModel;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $ms_jenjang_id, $nama_jenjang, $alamat, $slug, $urutan, $deskripsi;
    public $slugWasEdited = false;

    protected $listeners = ['loadDataJenjang'];

    public function loadDataJenjang($ms_jenjang_id)
    {
        $jenjang = JenjangModel::findOrFail($ms_jenjang_id);

        $this->ms_jenjang_id = $jenjang->ms_jenjang_id;
        $this->nama_jenjang = $jenjang->nama_jenjang;
        $this->alamat = $jenjang->alamat;
        $this->slug = $jenjang->slug ?: Str::slug($jenjang->nama_jenjang);
        $this->urutan = $jenjang->urutan;
        $this->deskripsi = $jenjang->deskripsi;
        $this->slugWasEdited = false;

        $this->dispatchBrowserEvent('show-edit-modal'); // Menampilkan modal
    }

    public function updatedNamaJenjang($value)
    {
        if (! $this->slugWasEdited) {
            $this->slug = Str::slug($value);
        }
    }

    public function updatedSlug()
    {
        $this->slugWasEdited = true;
    }

    public function rules()
    {
        return [
            'nama_jenjang' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('ms_jenjang', 'slug')->ignore($this->ms_jenjang_id, 'ms_jenjang_id'),
            ],
            'urutan' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('ms_jenjang', 'urutan')->ignore($this->ms_jenjang_id, 'ms_jenjang_id'),
            ],
            'deskripsi' => 'nullable|string',
        ];
    }

    protected $messages = [
        'nama_jenjang.required' => 'Nama jenjang tidak boleh kosong',
        'slug.required' => 'Slug tidak boleh kosong',
        'slug.unique' => 'Slug ini sudah digunakan, pilih slug lain',
        'urutan.required' => 'Urutan tidak boleh kosong',
        'urutan.integer' => 'Urutan harus berupa angka',
        'urutan.min' => 'Urutan harus minimal 1',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function updateJenjang()
    {
        $this->slug = Str::slug($this->slug ?: $this->nama_jenjang);
        $validatedData = $this->validate();

        $jenjang = JenjangModel::where('ms_jenjang_id', $this->ms_jenjang_id)->firstOrFail();
        $jenjang->update($validatedData);

        $this->dispatchBrowserEvent('alertify-success', ['message' => 'Berhasil mengubah jenjang!']);
        $this->dispatchBrowserEvent('hide-edit-modal', ['modalId' => 'ModalEditJenjang']);
        $this->emit('refreshJenjangs');
    }

    public function render()
    {
        return view('livewire.akademik.jenjang.edit');
    }
}
