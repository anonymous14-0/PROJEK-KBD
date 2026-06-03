<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nama tabel (opsional, tapi aman)
    protected $table = 'users';

    // Primary key kustom
    protected $primaryKey = 'id_user';

    // Karena bukan 'id'
    public $incrementing = true;
    protected $keyType = 'int';

    // Mass assignment
    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'role',
        'id_siswa',
        'id_guru',
        'is_active',
        'must_change_password',
    ];

    // Hidden
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_active' => 'boolean',
            'must_change_password' => 'boolean',
        ];
    }

    // ==========================================
    // MUTATOR & ACCESSOR UNTUK ENKRIPSI EMAIL
    // ==========================================
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = self::encryptData($value);
    }

    public function getEmailAttribute($value)
    {
        return self::decryptData($value);
    }

    public static function encryptData($value)
    {
        if (!$value) return $value;
        $key = hash('sha256', env('APP_KEY', 'siakad_secret_key_aes256'), true);
        $iv = substr(hash('sha256', 'siakad_deterministic_iv'), 0, 16);
        return base64_encode(openssl_encrypt($value, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
    }

    public static function decryptData($value)
    {
        if (!$value) return $value;
        $key = hash('sha256', env('APP_KEY', 'siakad_secret_key_aes256'), true);
        $iv = substr(hash('sha256', 'siakad_deterministic_iv'), 0, 16);
        return openssl_decrypt(base64_decode($value), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    }

    /**
     * RELASI
     */

    // User milik 1 siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    // User milik 1 guru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    // User punya banyak log aktivitas
    public function log()
    {
        return $this->hasMany(AktivitasLog::class, 'id_user');
    }
}
