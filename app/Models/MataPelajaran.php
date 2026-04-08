<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran';
    protected $primaryKey = 'id_mapel';
    
    protected $fillable = [
        'kode_mapel',
        'nama_mapel',
        'jurusan',
        'id_guru'
    ];

    // Relasi: Mapel ini diampu oleh seorang Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}