<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nama tabel (opsional, tapi aman)
    protected $table = 'users';

    // Primary key kustom
    protected $primaryKey = 'id_user';

    // Karena bukan 'id'
    public $incrementing = true;
    protected $keyType = 'int';

    // Mass assignment
    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'role',
        'id_siswa',
        'id_guru',
        'is_active',
        'must_change_password',
    ];

    // Hidden
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_active' => 'boolean',
            'must_change_password' => 'boolean',
        ];
    }

    /**
     * RELASI
     */

    // User milik 1 siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    // User milik 1 guru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    // User punya banyak log aktivitas
    public function log()
    {
        return $this->hasMany(AktivitasLog::class, 'id_user');
    }
}
