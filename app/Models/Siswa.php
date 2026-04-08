<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    
    // Tambahkan ini agar tidak error saat simpan data
    public $timestamps = false;

    protected $fillable = [
        'nis', 
        'nama_lengkap', 
        'jenis_kelamin', 
        'id_kelas'
    ];

    /**
     * Relasi ke Model Kelas
     */
    public function kelas() 
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}