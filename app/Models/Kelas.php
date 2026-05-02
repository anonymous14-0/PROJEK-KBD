<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'kelas';

    // Primary Key kustom
    protected $primaryKey = 'id_kelas';

    // Karena bukan 'id', ini penting
    public $incrementing = true;
    protected $keyType = 'int';

    // Mass assignment
    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'jurusan',
        'tahun_ajaran'
    ];

    // (Opsional) casting biar tipe data jelas
    protected $casts = [
        'tingkat' => 'string',
    ];

    /**
     * RELASI
     */

    // 1 kelas punya banyak siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas');
    }

    // (Opsional) akses nilai lewat siswa
    public function nilai()
    {
        return $this->hasManyThrough(
            Nilai::class,
            Siswa::class,
            'id_kelas', // FK di siswa
            'id_siswa', // FK di nilai
            'id_kelas', // PK di kelas
            'id_siswa'  // PK di siswa
        );
    }
}
