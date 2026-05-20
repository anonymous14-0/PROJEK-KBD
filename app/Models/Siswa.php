<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'siswa';

    // Primary key kustom
    protected $primaryKey = 'id_siswa';

    // Karena bukan 'id'
    public $incrementing = true;
    protected $keyType = 'int';

    // Aktifkan timestamps (karena ada di migration)
    public $timestamps = true;

    // Mass assignment
    protected $fillable = [
        'nis',
        'nama_lengkap',
        'jenis_kelamin',
        'id_kelas'
    ];

    // (Optional) casting
    protected $casts = [
        'nis' => 'encrypted',
        'jenis_kelamin' => 'string',
    ];

    /**
     * RELASI
     */

    // Siswa milik satu kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    // Siswa punya banyak nilai
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_siswa');
    }

    // Siswa punya satu akun user
    public function user()
    {
        return $this->hasOne(User::class, 'id_siswa');
    }

    protected static function booted(): void
    {
        static::saving(function (Siswa $siswa): void {
            if ($siswa->nis !== null) {
                $siswa->nis_hash = hash('sha256', strtolower(trim((string) $siswa->nis)));
            }
        });
    }
}

