<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AktivitasLog extends Model
{
    protected $table = 'aktivitas_log';
    protected $primaryKey = 'id_log';
    
    // Karena di migrasi kita hanya pakai created_at, nonaktifkan updated_at otomatis
    public $timestamps = false; 

    protected $fillable = [
        'id_user',
        'aktivitas',
        'created_at'
    ];

    // Relasi: Log ini dimiliki oleh seorang User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}