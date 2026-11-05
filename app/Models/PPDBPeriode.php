<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class PPDBPeriode extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ppdb_periode';
    protected $primaryKey = 'ppdb_periode_id'; // Nama kolom primary key

    protected $fillable = [
        'ms_jenjang_id',
        'nama_periode',
        'tanggal_mulai',
        'tanggal_selesai',
        'tautan_grup',
        'status',
        'deskripsi',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
        'tautan_grup'     => 'string',
    ];

    public function ms_jenjang()
    {
        return $this->belongsTo(
            Jenjang::class, 'ms_jenjang_id', 'ms_jenjang_id'
        );
    }
    public function ppdb_gelombang()
    {
        return $this->hasMany(
            PPDBGelombang::class, 'ppdb_periode_id', 'ppdb_periode_id'
        );
    }

    public function scopeForAuthorizedJenjang(Builder $query, $userId): Builder
    {
        return $query->whereIn('ms_jenjang_id', function ($subquery) use ($userId) {
            $subquery->select('ms_jenjang_id')
                ->from('ms_akses_jenjang')
                ->where('ms_pengguna_id', $userId);
        });
    }
}
