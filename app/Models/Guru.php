<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';

    // Jika di database kamu tidak ada kolom auto-increment id, 
    // dan menggunakan NIP sebagai kunci utama:
    protected $primaryKey = 'nip'; 
    public $incrementing = false; // NIP biasanya bukan auto-incrementing integer

    // INI KUNCINYA: Matikan timestamp karena kolomnya tidak ada di DB
    public $timestamps = false;

    protected $fillable = [
        'nip', 
        'nama_lengkap', 
        'jenis_kelamin'
    ];

    public function mataPelajaran()
    {
        return $this->hasMany(MataPelajaran::class, 'id_guru');
    }
}