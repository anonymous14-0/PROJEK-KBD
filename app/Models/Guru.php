<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'guru';

    // Primary key sesuai database
    protected $primaryKey = 'id_guru';

    // Karena custom key
    public $incrementing = true;
    protected $keyType = 'int';

    // Aktifkan timestamps (karena di migration kamu pakai timestamps)
    public $timestamps = true;

    // Mass assignment
    protected $fillable = [
        'nip',
        'nama_lengkap',
        'jenis_kelamin'
    ];

    // (Optional) casting
    protected $casts = [
        'nip' => 'encrypted',
        'jenis_kelamin' => 'string',
    ];

    /**
     * RELASI
     */

    // Guru punya banyak mata pelajaran
    public function mataPelajaran()
    {
        return $this->hasMany(MataPelajaran::class, 'id_guru');
    }

    // Guru punya 1 akun user
    public function user()
    {
        return $this->hasOne(User::class, 'id_guru');
    }

    protected static function booted(): void
    {
        static::saving(function (Guru $guru): void {
            if ($guru->nip !== null) {
                $guru->nip_hash = hash('sha256', strtolower(trim((string) $guru->nip)));
            }
        });
    }
}

