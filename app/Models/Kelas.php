<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'kelas';

    // Primary Key kustom
    protected $primaryKey = 'id_kelas';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'nama_kelas', 
        'tingkat', 
        'jurusan', 
        'tahun_ajaran'
    ];

    /**
     * Relasi: Satu kelas memiliki banyak siswa
     */
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas');
    }
}