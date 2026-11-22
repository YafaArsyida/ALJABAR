<?php

namespace App\Http\Livewire\Akademik\Guru;

use App\Http\Controllers\HelperController;
use App\Models\Jabatan;
use App\Models\Jenjang;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public $ms_pegawai_id;
    public $ms_jenjang_id;
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
    public $userConnected = false;

    protected $listeners = ['loadDataGuru'];

    protected $messages = [
        'nama_pegawai.required' => 'Nama guru wajib diisi.',
        'ms_jabatan_id.required' => 'Pilih jabatan guru.',
        'ms_jabatan_id.exists' => 'Jabatan yang dipilih tidak ditemukan.',
        'email.required' => 'Email untuk akun guru wajib diisi.',
        'email.email' => 'Masukkan alamat email yang valid.',
        'email.unique' => 'Email tersebut sudah terdaftar pada akun pengguna.',
        'password.min' => 'Kata sandi minimal 8 karakter.',
        'jenis_kelamin.in' => 'Pilih jenis kelamin yang valid.',
        'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
        'status.in' => 'Status keaktifan tidak valid.',
    ];

    public function loadDataGuru($id)
    {
        $pegawai = $this->accessiblePegawais()->with('akun_pengguna')->findOrFail($id);
        $user = $pegawai->akun_pengguna;

        $this->resetValidation();
        $this->ms_pegawai_id = $pegawai->ms_pegawai_id;
        $this->ms_jenjang_id = $pegawai->ms_jenjang_id;
        $this->userConnected = (bool) $user;
        $this->nama_pegawai = $pegawai->nama_pegawai;
        $this->nip = $pegawai->nip ?? '';
        $this->nik = $pegawai->nik ?? '';
        $this->jenis_kelamin = $pegawai->jenis_kelamin ?? '';
        $this->tempat_lahir = $pegawai->tempat_lahir ?? '';
        $this->tanggal_lahir = $pegawai->tanggal_lahir
            ? Carbon::parse($pegawai->tanggal_lahir)->format('Y-m-d')
            : '';
        $this->ms_jabatan_id = $pegawai->ms_jabatan_id;
        $this->email = $user->email ?? $pegawai->email ?? '';
        $this->password = '';
        $this->telepon = $pegawai->telepon ?? '';
        $this->tanggal_masuk = $pegawai->tanggal_masuk
            ? Carbon::parse($pegawai->tanggal_masuk)->format('Y-m-d')
            : '';
        $this->alamat = $pegawai->alamat ?? '';
        $this->deskripsi = $pegawai->deskripsi ?? '';
        $this->status = strcasecmp((string) $pegawai->status, 'Nonaktif') === 0 ? 'Nonaktif' : 'Aktif';
    }

    protected function rules(?User $user): array
    {
        $emailRule = Rule::unique('ms_pengguna', 'email');

        if ($user) {
            $emailRule->ignore($user->ms_pengguna_id, 'ms_pengguna_id');
        }

        return [
            'nama_pegawai' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'nik' => 'nullable|string|max:30',
            'jenis_kelamin' => ['nullable', Rule::in(['L', 'P'])],
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date|before:today',
            'ms_jabatan_id' => ['required', Rule::exists('ms_jabatan', 'ms_jabatan_id')->whereNull('deleted_at')],
            'email' => ['required', 'email', 'max:255', $emailRule],
            'password' => $user ? 'nullable|string|min:8' : 'required|string|min:8',
            'telepon' => 'nullable|string|max:20',
            'tanggal_masuk' => 'nullable|date',
            'alamat' => 'nullable|string|max:1000',
            'deskripsi' => 'nullable|string|max:1000',
            'status' => ['required', Rule::in(['Aktif', 'Nonaktif'])],
        ];
    }

    public function updateGuru()
    {
        abort_unless($this->ms_pegawai_id, 404);
        $pegawai = $this->accessiblePegawais()->findOrFail($this->ms_pegawai_id);
        $user = $pegawai->akun_pengguna;
        $this->email = strtolower(trim($this->email));
        $validated = $this->validate($this->rules($user));

        DB::transaction(function () use ($pegawai, $user, $validated) {
            if (!$user) {
                $user = User::create([
                    'nama' => $validated['nama_pegawai'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'telepon' => $validated['telepon'] ?: null,
                    'peran' => 'GURU',
                    'current_session' => null,
                ]);
            } else {
                $user->nama = $validated['nama_pegawai'];
                $user->email = $validated['email'];
                $user->telepon = $validated['telepon'] ?: null;
                $user->peran = 'GURU';

                if ($validated['password'] ?? null) {
                    $user->password = Hash::make($validated['password']);
                }

                $user->save();
            }

            $user->ms_jenjang()->syncWithoutDetaching([(int) $pegawai->ms_jenjang_id]);

            $pegawai->update([
                'user_id' => $user->ms_pengguna_id,
                'ms_pengguna_id' => auth()->id(),
                'nama_pegawai' => $validated['nama_pegawai'],
                'nip' => $validated['nip'] ?: null,
                'nik' => $validated['nik'] ?: null,
                'jenis_kelamin' => $validated['jenis_kelamin'] ?: null,
                'tempat_lahir' => $validated['tempat_lahir'] ?: null,
                'tanggal_lahir' => $validated['tanggal_lahir'] ?: null,
                'ms_jabatan_id' => $validated['ms_jabatan_id'],
                'jenis_pegawai' => 'GURU',
                'tanggal_masuk' => $validated['tanggal_masuk'] ?: null,
                'email' => $validated['email'],
                'telepon' => $validated['telepon'] ?: null,
                'alamat' => $validated['alamat'] ?: null,
                'deskripsi' => $validated['deskripsi'] ?: null,
                'status' => $validated['status'],
            ]);
        });

        $this->dispatchBrowserEvent('hide-modal', ['modalId' => 'ModalEditGuru']);
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Data guru dan akun pengguna berhasil diperbarui.',
        ]);
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
        return view('livewire.akademik.guru.edit', [
            'jenjang' => $this->ms_jenjang_id ? Jenjang::find($this->ms_jenjang_id) : null,
            'jabatans' => Jabatan::query()->orderBy('nama_jabatan')->get(),
        ]);
    }
}
