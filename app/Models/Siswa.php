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
        'jenis_kelamin' => 'string',
    ];

    // ==========================================
    // MUTATOR & ACCESSOR UNTUK ENKRIPSI NIS
    // ==========================================
    public function setNisAttribute($value)
    {
        $this->attributes['nis'] = self::encryptData($value);
    }

    public function getNisAttribute($value)
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
}
