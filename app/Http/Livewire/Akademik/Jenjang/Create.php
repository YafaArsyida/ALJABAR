<?php

namespace App\Http\Livewire\Akademik\Jenjang;

use Livewire\Component;
use App\Models\Jenjang as JenjangModel;
use Illuminate\Support\Str;

class Create extends Component
{
    public $nama_jenjang, $alamat, $slug, $urutan, $deskripsi;
    public $slugWasEdited = false;

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

    protected function rules()
    {
        return [
            'nama_jenjang' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|unique:ms_jenjang,slug',
            'urutan' => 'required|integer|min:1|unique:ms_jenjang,urutan',
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
        'urutan.unique' => 'Urutan ini sudah digunakan, pilih angka lain',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->slug = Str::slug($this->slug ?: $this->nama_jenjang);
        $validatedData = $this->validate();
        JenjangModel::create($validatedData);

        $this->dispatchBrowserEvent('alertify-success', ['message' => 'Berhasil menambah jenjang!']);
        $this->resetInput();
        $this->dispatchBrowserEvent('hide-create-modal', ['modalId' => 'ModalAddJenjang']);
        $this->emit('refreshJenjangs');
    }

    public function resetInput()
    {
        $this->nama_jenjang = '';
        $this->alamat = '';
        $this->slug = '';
        $this->urutan = '';
        $this->deskripsi = '';
        $this->slugWasEdited = false;
    }

    public function render()
    {
        return view('livewire.akademik.jenjang.create');
    }
}
