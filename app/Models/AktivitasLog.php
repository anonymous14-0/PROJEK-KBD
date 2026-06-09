<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AktivitasLog extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'aktivitas_log';

    // Primary key kustom
    protected $primaryKey = 'id_log';

    // Karena bukan 'id'
    public $incrementing = true;
    protected $keyType = 'int';

    // Aktifkan timestamps (sesuai migration)
    public $timestamps = true;

    // Mass assignment
    protected $fillable = [
        'id_user',
        'aktivitas',
        'ip_address',
        'ipv4_address',
        'user_agent'
    ];

    /**
     * RELASI
     */

    // Log milik 1 user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
