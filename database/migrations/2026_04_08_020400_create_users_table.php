<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // TABEL USERS (Untuk Akun Login)
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nama_lengkap');
            $table->enum('role', ['admin', 'audit', 'guru', 'siswa']);

            $table->unsignedBigInteger('id_siswa')->nullable();
            $table->unsignedBigInteger('id_guru')->nullable();

            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();

            $table->softDeletes();

            $table->foreign('id_siswa')
                  ->references('id_siswa')
                  ->on('siswa')
                  ->onDelete('cascade');

            $table->foreign('id_guru')
                  ->references('id_guru')
                  ->on('guru')
                  ->onDelete('cascade');

            $table->index('email');
            $table->index('role');
            $table->index('id_siswa');
            $table->index('id_guru');
        });

        // Tabel bawaan Laravel untuk fitur Lupa Password
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
            $table->index('email');
        });

        // Tabel bawaan Laravel untuk menyimpan Session Browser
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();

            $table->foreign('user_id')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');
        });

        if (DB::getDriverName() !== 'sqlite') {
            DB::statement(
                "ALTER TABLE users ADD CONSTRAINT chk_role CHECK (role IN ('admin','audit','guru','siswa'))"
            );
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};