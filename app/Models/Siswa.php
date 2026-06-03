<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    // Mengaktifkan fitur SoftDeletes
    use HasFactory, SoftDeletes;

    // Konfigurasi tabel
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    // Kolom yang bisa diisi (Fillable)
    protected $fillable = ['nis', 'nama_lengkap', 'jenis_kelamin', 'id_kelas'];
    protected $casts = ['jenis_kelamin' => 'string'];

    // Mutator untuk otomatis mengenkripsi NIS
    public function setNisAttribute($value)
    {
        $this->attributes['nis'] = self::encryptData($value);
    }

    // Accessor untuk otomatis mendekripsi NIS
    public function getNisAttribute($value)
    {
        return self::decryptData($value);
    }

    // Fungsi Enkripsi AES-256
    public static function encryptData($value)
    {
        if (!$value) return $value;
        $key = hash('sha256', env('APP_KEY', 'siakad_secret_key_aes256'), true);
        $iv = substr(hash('sha256', 'siakad_deterministic_iv'), 0, 16);
        return base64_encode(openssl_encrypt($value, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
    }

    // Fungsi Dekripsi AES-256
    public static function decryptData($value)
    {
        if (!$value) return $value;
        $key = hash('sha256', env('APP_KEY', 'siakad_secret_key_aes256'), true);
        $iv = substr(hash('sha256', 'siakad_deterministic_iv'), 0, 16);
        return openssl_decrypt(base64_decode($value), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    }

    // Relasi: Siswa termasuk ke dalam satu Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    // Relasi: Siswa memiliki banyak nilai
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_siswa');
    }

    // Relasi: Siswa memiliki satu akun login (User)
    public function user()
    {
        return $this->hasOne(User::class, 'id_siswa');
    }
}
