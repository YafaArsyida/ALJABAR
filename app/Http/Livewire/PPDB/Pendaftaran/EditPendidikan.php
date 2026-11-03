<?php

namespace App\Http\Livewire\PPDB\Pendaftaran;

use App\Models\PPDBPendaftaran;
use App\Models\PPDBPendidikan;
use App\Services\PPDB\PPDBPendidikanService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class EditPendidikan extends Component
{
    public $periodeId;
    public $pendaftaranId;

    public $asal_sekolah = '';
    public $alamat_asal_sekolah = '';
    public $npsn_asal_sekolah = '';
    public $jenjang_asal = 'TK';
    public $tahun_lulus = '';
    public $nomor_ijazah = '';

    public function mount($pendaftaranId)
    {
        $this->pendaftaranId = $pendaftaranId;

        $pendaftaran = $this->ambilPendaftaranMilikPengguna();

        $this->periodeId = $pendaftaran->ppdb_periode_id;

        $this->pastikanBolehUbah($pendaftaran);

        $pendidikan = PPDBPendidikan::query()
            ->where(
                'ppdb_pendaftaran_id',
                $pendaftaran->ppdb_pendaftaran_id
            )
            ->firstOrFail();

        $this->isiForm($pendidikan);
    }

    /**
     * Mengambil pendaftaran milik pengguna yang sedang login.
     */
    protected function ambilPendaftaranMilikPengguna()
    {
        return PPDBPendaftaran::query()
            ->with('ppdb_periode.ms_jenjang')
            ->whereKey($this->pendaftaranId)
            ->where('ms_pengguna_id', Auth::id())
            ->firstOrFail();
    }

    /**
     * Menentukan apakah data masih boleh diubah.
     */
    protected function bolehUbahData($status)
    {
        return ! in_array(
            strtolower(trim((string) $status)),
            ['diterima', 'pengecekan'],
            true
        );
    }

    protected function pastikanBolehUbah(PPDBPendaftaran $pendaftaran): void
    {
        if (! $this->bolehUbahData($pendaftaran->status)) {
            abort(
                403,
                'Pendaftaran tidak dapat diubah pada status saat ini.'
            );
        }
    }

    protected function isiForm(PPDBPendidikan $pendidikan)
    {
        $this->asal_sekolah = $pendidikan->asal_sekolah ?? '';
        $this->alamat_asal_sekolah = $pendidikan->alamat_asal_sekolah ?? '';
        $this->npsn_asal_sekolah =
            $pendidikan->npsn_asal_sekolah ?? '';
        $this->jenjang_asal =
            $pendidikan->jenjang_asal ?? 'TK';
        $this->tahun_lulus = $pendidikan->tahun_lulus ?? '';
        $this->nomor_ijazah = $pendidikan->nomor_ijazah ?? '';
    }

    protected function rules()
    {
        return [
            'asal_sekolah' => [
                'nullable',
                'string',
                'max:255',
            ],
            'alamat_asal_sekolah' => 'nullable|string|max:1000',
            'jenjang_asal' => [
                'required',
                'in:TK,RA,SD,PAUD,TIDAK_ADA',
            ],
            'tahun_lulus' => [
                'nullable',
                'integer',
                'min:' . (date('Y') - 10),
                'max:' . max((int) date('Y'), 2027),
            ],
        ];
    }

    protected $messages = [
        'asal_sekolah.max' => 'Nama sekolah maksimal 255 karakter.',

        'alamat_asal_sekolah.string' => 'Alamat pendidikan sebelumnya harus berupa teks.',
        'alamat_asal_sekolah.max' => 'Alamat pendidikan sebelumnya maksimal 1000 karakter.',

        'jenjang_asal.required' => 'Jenjang pendidikan asal wajib dipilih.',

        'jenjang_asal.in' => 'Jenjang pendidikan asal tidak valid.',

        'tahun_lulus.integer' => 'Tahun lulus harus berupa angka.',

        'tahun_lulus.min' => 'Tahun lulus terlalu lama. Silakan periksa kembali.',

        'tahun_lulus.max' => 'Tahun lulus tidak boleh melebihi tahun berjalan.',

    ];

    
    public function update()
    {
        // Periksa status sebelum validasi dan penyimpanan.
        $pendaftaran = $this->ambilPendaftaranMilikPengguna();

        $this->pastikanBolehUbah($pendaftaran);

        $data = $this->validate();

        DB::transaction(function () use ($data) {
            $pendaftaran = PPDBPendaftaran::query()
                ->whereKey($this->pendaftaranId)
                ->where('ms_pengguna_id', Auth::id())
                ->where('ppdb_periode_id', $this->periodeId)
                ->lockForUpdate()
                ->first();

            if (!$pendaftaran) {
                throw ValidationException::withMessages([
                    'asal_sekolah' =>
                        'Pendaftaran tidak ditemukan atau bukan milik Anda.',
                ]);
            }

            // Periksa kembali status di dalam transaksi.
            $this->pastikanBolehUbah($pendaftaran);

            $pendidikan = PPDBPendidikan::query()
                ->where(
                    'ppdb_pendaftaran_id',
                    $pendaftaran->ppdb_pendaftaran_id
                )
                ->lockForUpdate()
                ->first();

            if (!$pendidikan) {
                throw ValidationException::withMessages([
                    'asal_sekolah' =>
                        'Data pendidikan belum tersedia. Silakan simpan data terlebih dahulu.',
                ]);
            }

            PPDBPendidikanService::update($pendidikan, $data);
        });

        $pendaftaran = $this->ambilPendaftaranMilikPengguna();

        $slugJenjang = $pendaftaran->ppdb_periode->ms_jenjang->slug;

        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Data pendidikan berhasil diperbarui.',
        ]);

        return redirect()->route('ppdb.pendaftaran.pendidikan', [
            'jenjang' => $slugJenjang,
        ]);
    }

    
    public function render()
    {
        $pendaftaran = $this->ambilPendaftaranMilikPengguna();

        return view('livewire.p-p-d-b.pendaftaran.edit-pendidikan', [
            'pendaftaran' => $pendaftaran,
        ]);
    }
}
