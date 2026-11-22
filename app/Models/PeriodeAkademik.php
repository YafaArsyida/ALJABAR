<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodeAkademik extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ms_periode_akademik';

    protected $primaryKey = 'ms_periode_akademik_id';

    protected $fillable = [
        'nama_periode',
        'ms_jenjang_id',
        'ms_tahun_ajar_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'urutan',
        'status',
        'deskripsi',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function ms_jenjang()
    {
        return $this->belongsTo(
            Jenjang::class,
            'ms_jenjang_id',
            'ms_jenjang_id'
        );
    }

    public function ms_tahun_ajar()
    {
        return $this->belongsTo(
            TahunAjar::class,
            'ms_tahun_ajar_id',
            'ms_tahun_ajar_id'
        );
    }

    public function ms_penugasan_guru()
    {
        return $this->hasMany(
            PenugasanGuru::class,
            'ms_periode_akademik_id',
            'ms_periode_akademik_id'
        );
    }
}
