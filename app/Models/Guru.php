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
        'jenis_kelamin' => 'string',
    ];

    // ==========================================
    // MUTATOR & ACCESSOR UNTUK ENKRIPSI NIP
    // ==========================================
    public function setNipAttribute($value)
    {
        $this->attributes['nip'] = self::encryptData($value);
    }

    public function getNipAttribute($value)
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
}
