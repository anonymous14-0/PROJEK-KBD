<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel Users Utama (Sudah disesuaikan dengan gambar database kamu)
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user'); // Primary Key kustom
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nama_lengkap');
            $table->enum('role', ['admin', 'audit', 'guru', 'siswa']);
            $table->unsignedBigInteger('id_siswa')->nullable(); 
            $table->unsignedBigInteger('id_guru')->nullable();  
            $table->boolean('is_active')->default(true);
            $table->rememberToken(); // Penting untuk fitur "Remember Me" Breeze
            $table->timestamps();
        });

        // Tabel untuk fitur Reset Password (Dibutuhkan Breeze)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Tabel untuk fitur Session (Dibutuhkan Breeze)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            // Perhatikan ini: Kita pakai 'id_user' karena primary key di tabel users sudah diubah
            $table->foreignId('user_id')->nullable()->index()->references('id_user')->on('users');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};