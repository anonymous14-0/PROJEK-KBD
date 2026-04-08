<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // 1. Definisikan Primary Key kustom kamu
    protected $primaryKey = 'id_user';

    /**
     * 2. Daftarkan semua kolom yang boleh diisi (Mass Assignable)
     */
    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'role',
        'id_siswa',
        'id_guru',
        'is_active',
    ];

    /**
     * Attributes hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean', // Tambahkan ini agar otomatis jadi true/false
        ];
    }
}