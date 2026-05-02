<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nilai extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'nilai';

    // Primary key kustom
    protected $primaryKey = 'id_nilai';

    // Karena bukan 'id'
    public $incrementing = true;
    protected $keyType = 'int';

    // Aktifkan timestamps (sesuai migration)
    public $timestamps = true;

    // Mass assignment
    protected $fillable = [
        'id_siswa',
        'id_mapel',
        'nilai_uts',
        'nilai_uas',
        'semester',
        'tahun_ajaran'
    ];

    // (Optional) casting
    protected $casts = [
        'nilai_uts' => 'integer',
        'nilai_uas' => 'integer',
    ];

    /**
     * RELASI
     */

    // Nilai milik 1 siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    // Nilai milik 1 mata pelajaran
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel');
    }

    // (Optional) akses guru lewat mapel
    public function guru()
    {
        return $this->hasOneThrough(
            Guru::class,
            MataPelajaran::class,
            'id_mapel', // FK di mapel
            'id_guru',  // FK di guru
            'id_mapel', // FK di nilai
            'id_guru'   // PK di mapel
        );
    }
}
