<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MataPelajaran extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'mata_pelajaran';

    // Primary key kustom
    protected $primaryKey = 'id_mapel';

    // Karena bukan 'id'
    public $incrementing = true;
    protected $keyType = 'int';

    // Aktifkan timestamps (karena ada di migration)
    public $timestamps = true;

    // Mass assignment
    protected $fillable = [
        'kode_mapel',
        'nama_mapel',
        'jurusan',
        'id_guru'
    ];

    // (Optional) casting
    protected $casts = [
        'jurusan' => 'string',
    ];

    /**
     * RELASI
     */

    // Mapel dimiliki oleh 1 guru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    // Mapel punya banyak nilai
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_mapel');
    }
}
