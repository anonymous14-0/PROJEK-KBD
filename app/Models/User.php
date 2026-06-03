<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    // Menambahkan SoftDeletes untuk manajemen hapus akun
    use HasFactory, Notifiable, SoftDeletes;

    // Pengaturan Tabel
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom-kolom akun
    protected $fillable = [
        'nama_lengkap', 'email', 'password', 'role',
        'id_siswa', 'id_guru', 'is_active', 'must_change_password',
    ];

    // Kolom ini akan disembunyikan saat data User di-print/dikembalikan bentuk JSON
    protected $hidden = ['password', 'remember_token'];

    // Konversi tipe data otomatis (Casting)
    protected function casts(): array
    {
        return [
            'password' => 'hashed', // Password otomatis ter-hash
            'is_active' => 'boolean',
            'must_change_password' => 'boolean',
        ];
    }

    // Mutator: Enkripsi Email di database
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = self::encryptData($value);
    }

    // Accessor: Dekripsi Email agar bisa dibaca web
    public function getEmailAttribute($value)
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

    // Relasi akun milik siapa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    // Relasi log aktivitas user
    public function log()
    {
        return $this->hasMany(AktivitasLog::class, 'id_user');
    }
}
