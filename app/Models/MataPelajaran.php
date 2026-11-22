<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MataPelajaran extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'ms_mata_pelajaran';

    protected $primaryKey = 'ms_mata_pelajaran_id';

    protected $fillable = [
        'nama_mapel',
        'kode_mapel',
        'ms_jenjang_id',
        'urutan',
        'deskripsi',
        'status',
    ];

    public function ms_jenjang()
    {
        return $this->belongsTo(
            Jenjang::class,
            'ms_jenjang_id',
            'ms_jenjang_id'
        );
    }
}
