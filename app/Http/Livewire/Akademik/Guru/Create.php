<?php

namespace App\Http\Livewire\Akademik\Guru;

use App\Models\Jabatan;
use App\Models\Jenjang;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public $selectedJenjang;
    public $nama_pegawai = '';
    public $nip = '';
    public $nik = '';
    public $jenis_kelamin = '';
    public $tempat_lahir = '';
    public $tanggal_lahir = '';
    public $ms_jabatan_id = '';
    public $email = '';
    public $password = '';
    public $telepon = '';
    public $tanggal_masuk = '';
    public $alamat = '';
    public $deskripsi = '';
    public $status = 'Aktif';

    protected $listeners = ['showCreateGuru'];

    protected $messages = [
        'nama_pegawai.required' => 'Nama guru wajib diisi.',
        'ms_jabatan_id.required' => 'Pilih jabatan guru.',
        'ms_jabatan_id.exists' => 'Jabatan yang dipilih tidak ditemukan.',
        'email.required' => 'Email untuk akun guru wajib diisi.',
        'email.email' => 'Masukkan alamat email yang valid.',
        'email.unique' => 'Email tersebut sudah terdaftar pada akun pengguna.',
        'password.required' => 'Kata sandi awal akun guru wajib diisi.',
        'password.min' => 'Kata sandi minimal 8 karakter.',
        'jenis_kelamin.in' => 'Pilih jenis kelamin yang valid.',
        'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
        'status.in' => 'Status keaktifan tidak valid.',
    ];

    public function showCreateGuru($selectedJenjang)
    {
        $this->resetValidation();
        $this->resetForm();
        $this->selectedJenjang = $selectedJenjang;
    }

    protected function rules(): array
    {
        return [
            'nama_pegawai' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'nik' => 'nullable|string|max:30',
            'jenis_kelamin' => ['nullable', Rule::in(['L', 'P'])],
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date|before:today',
            'ms_jabatan_id' => ['required', Rule::exists('ms_jabatan', 'ms_jabatan_id')->whereNull('deleted_at')],
            'email' => ['required', 'email', 'max:255', Rule::unique('ms_pengguna', 'email')],
            'password' => 'required|string|min:8',
            'telepon' => 'nullable|string|max:20',
            'tanggal_masuk' => 'nullable|date',
            'alamat' => 'nullable|string|max:1000',
            'deskripsi' => 'nullable|string|max:1000',
            'status' => ['required', Rule::in(['Aktif', 'Nonaktif'])],
            'selectedJenjang' => [
                'required',
                Rule::exists('ms_jenjang', 'ms_jenjang_id')
                    ->whereNull('deleted_at')
                    ->whereIn('ms_jenjang_id', $this->availableJenjangIds()),
            ],
        ];
    }

    public function save()
    {
        $this->email = strtolower(trim($this->email));
        $validated = $this->validate();

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'nama' => $validated['nama_pegawai'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'telepon' => $validated['telepon'] ?: null,
                'peran' => 'GURU',
                'current_session' => null,
            ]);

            $user->ms_jenjang()->syncWithoutDetaching([(int) $validated['selectedJenjang']]);

            Pegawai::create([
                'user_id' => $user->ms_pengguna_id,
                'ms_pengguna_id' => auth()->id(),
                'nama_pegawai' => $validated['nama_pegawai'],
                'nip' => $validated['nip'] ?: null,
                'nik' => $validated['nik'] ?: null,
                'jenis_kelamin' => $validated['jenis_kelamin'] ?: null,
                'tempat_lahir' => $validated['tempat_lahir'] ?: null,
                'tanggal_lahir' => $validated['tanggal_lahir'] ?: null,
                'ms_jabatan_id' => $validated['ms_jabatan_id'],
                'ms_jenjang_id' => $validated['selectedJenjang'],
                'jenis_pegawai' => 'GURU',
                'tanggal_masuk' => $validated['tanggal_masuk'] ?: null,
                'email' => $validated['email'],
                'telepon' => $validated['telepon'] ?: null,
                'alamat' => $validated['alamat'] ?: null,
                'deskripsi' => $validated['deskripsi'] ?: null,
                'status' => $validated['status'],
            ]);
        });

        $this->dispatchBrowserEvent('hide-modal', ['modalId' => 'ModalAddGuru']);
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Data guru dan akun pengguna berhasil dibuat.',
        ]);
        $this->emit('refreshGurus');
        $this->resetForm();
    }

    private function availableJenjangIds(): array
    {
        return auth()->user()->ms_jenjang()->pluck('ms_jenjang.ms_jenjang_id')->all();
    }

    private function resetForm()
    {
        $this->reset([
            'nama_pegawai',
            'nip',
            'nik',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'ms_jabatan_id',
            'email',
            'password',
            'telepon',
            'tanggal_masuk',
            'alamat',
            'deskripsi',
        ]);
        $this->status = 'Aktif';
    }

    public function render()
    {
        return view('livewire.akademik.guru.create', [
            'jenjang' => $this->selectedJenjang ? Jenjang::find($this->selectedJenjang) : null,
            'jabatans' => Jabatan::query()->orderBy('nama_jabatan')->get(),
        ]);
    }
}
