<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    // Mengaktifkan fitur SoftDeletes di dalam Model
    use HasFactory, SoftDeletes;

    // Konfigurasi tabel dan primary key
    protected $table = 'guru';
    protected $primaryKey = 'id_guru';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    // Kolom-kolom yang diizinkan untuk diisi secara massal (Mass Assignment)
    protected $fillable = ['nip', 'nama_lengkap', 'jenis_kelamin'];

    // Konversi tipe data otomatis oleh Laravel
    protected $casts = ['jenis_kelamin' => 'string'];

    // Mutator: Otomatis mengenkripsi NIP saat data mau disimpan ke database
    public function setNipAttribute($value)
    {
        $this->attributes['nip'] = self::encryptData($value);
    }

    // Accessor: Otomatis mendekripsi NIP saat data dipanggil dari database
    public function getNipAttribute($value)
    {
        return self::decryptData($value);
    }

    // Fungsi Kriptografi: Mengubah teks biasa menjadi sandi (AES-256)
    public static function encryptData($value)
    {
        if (!$value) return $value;
        $key = hash('sha256', env('APP_KEY', 'siakad_secret_key_aes256'), true);
        $iv = substr(hash('sha256', 'siakad_deterministic_iv'), 0, 16);
        return base64_encode(openssl_encrypt($value, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
    }

    // Fungsi Kriptografi: Mengubah sandi (ciphertext) kembali menjadi teks asli
    public static function decryptData($value)
    {
        if (!$value) return $value;
        $key = hash('sha256', env('APP_KEY', 'siakad_secret_key_aes256'), true);
        $iv = substr(hash('sha256', 'siakad_deterministic_iv'), 0, 16);
        return openssl_decrypt(base64_decode($value), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    }

    // Relasi: Satu Guru memiliki banyak Mata Pelajaran
    public function mataPelajaran()
    {
        return $this->hasMany(MataPelajaran::class, 'id_guru');
    }

    // Relasi: Satu Guru hanya memiliki satu Akun Login (User)
    public function user()
    {
        return $this->hasOne(User::class, 'id_guru');
    }
}
