<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ms_pegawai'; // Nama tabel
    protected $primaryKey = 'ms_pegawai_id'; // Nama kolom primary key

    protected $fillable = [
        // Relasi
        'user_id',
        'ms_pengguna_id',

        // Identitas
        'nama_pegawai',
        'nip',
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',

        // Kepegawaian
        'ms_jabatan_id',
        'ms_jenjang_id',
        'jenis_pegawai',
        'status_kepegawaian',
        'tanggal_masuk',
        'tanggal_keluar',

        // Kontak
        'email',
        'telepon',
        'alamat',

        // Integrasi dan informasi tambahan
        'pin_fingerspot',
        'foto',
        'deskripsi',

        // Status
        'status',
    ];

    /**
     * Relasi ke model Petugas
     */
    public function ms_pengguna()
    {
        return $this->belongsTo(User::class, 'ms_pengguna_id', 'ms_pengguna_id');
    }

    public function akun_pengguna()
    {
        return $this->belongsTo(User::class, 'user_id', 'ms_pengguna_id');
    }

    /**
     * Relasi ke model Jabatan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ms_jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'ms_jabatan_id', 'ms_jabatan_id');
    }

    /**
     * Relasi ke model Jenjang
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ms_jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'ms_jenjang_id', 'ms_jenjang_id');
    }


    public function ms_saldo_tabungan()
    {
        return $this->hasOne(SaldoTabungan::class, 'user_id', 'ms_pegawai_id')
            ->where('user_type', 'pegawai');
    }
    
    public function ms_transaksi_tabungan()
    {
        return $this->hasMany(TransaksiTabungan::class, 'user_id', 'ms_pegawai_id')
        ->where('user_type', 'pegawai');
    }
    public function total_kredit_tabungan()
    {
        // Menghitung total nominal kredit (Setoran)
        return $this->ms_transaksi_tabungan()
            ->where('jenis_transaksi', 'setoran')
            ->sum('nominal');
    }

    public function total_debit_tabungan()
    {
        // Menghitung total nominal debit (Penarikan)
        return $this->ms_transaksi_tabungan()
            ->where('jenis_transaksi', 'penarikan')
            ->sum('nominal');
    }

    /**
     * Total saldo terakhir untuk siswa ini
     */
    public function saldo_tabungan_pegawai()
    {
        // Menghitung saldo berdasarkan total kredit dikurangi total debit
        return $this->total_kredit_tabungan() - $this->total_debit_tabungan();
    }

    /**
     * Relasi ke model EduCard
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ms_educard()
    {
        return $this->hasOne(EduCard::class, 'ms_pegawai_id', 'ms_pegawai_id')
            ->where('jenis_pemilik', 'pegawai');
    }

    // =============== EDUPAY ===============
    public function ms_saldo_edupay()
    {
        return $this->hasOne(SaldoEduPay::class, 'user_id', 'ms_pegawai_id')
            ->where('user_type', 'pegawai');
    }
    public function ms_transaksi_edupay()
    {
        return $this->hasMany(TransaksiEduPay::class, 'user_id', 'ms_pegawai_id')
            ->where('user_type', 'pegawai');
    }

    public function total_pemasukan_edupay()
    {
        return $this->ms_transaksi_edupay()
            ->whereIn('jenis_transaksi', ['topup tunai', 'topup online', 'pengembalian dana'])
            ->sum('nominal');
    }

    public function total_penarikan_edupay()
    {
        return $this->ms_transaksi_edupay()
            ->where('jenis_transaksi', 'penarikan')
            ->sum('nominal');
    }

    public function total_pembayaran_edupay()
    {
        return $this->ms_transaksi_edupay()
            ->where('jenis_transaksi', 'pembayaran')
            ->sum('nominal');
    }

    public function total_pembayaran_kantin()
    {
        return $this->ms_transaksi_edupay()
            ->where('jenis_transaksi', 'kantin')
            ->sum('nominal');
    }

    public function total_pengeluaran_edupay()
    {
        return $this->total_penarikan_edupay()
            + $this->total_pembayaran_edupay()
            + $this->total_pembayaran_kantin();
    }

    public function saldo_edupay_pegawai()
    {
        return $this->total_pemasukan_edupay() - $this->total_pengeluaran_edupay();
    }

    public function ms_penugasan_guru()
    {
        return $this->hasMany(
            PenugasanGuru::class,
            'ms_pegawai_id',
            'ms_pegawai_id'
        );
    }
}
