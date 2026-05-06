<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),

            // SESUAIKAN DENGAN DATABASE
            'nama_lengkap' => fake()->name(),

            'password' => static::$password ??= Hash::make('password'),

            'role' => fake()->randomElement(['admin', 'audit', 'guru', 'siswa']),

            // relasi (optional, bisa null dulu)
            'id_siswa' => null,
            'id_guru' => null,

            'is_active' => true,
            'must_change_password' => false,

            'remember_token' => Str::random(10),

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
