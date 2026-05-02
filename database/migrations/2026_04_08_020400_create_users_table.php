<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ========================
        // TABEL USERS
        // ========================
        Schema::create('users', function (Blueprint $table) {
            // Primary Key
            $table->id('id_user');

            // Data login
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nama_lengkap');
            $table->enum('role', ['admin', 'audit', 'guru', 'siswa']);

            // Relasi ke siswa & guru
            $table->unsignedBigInteger('id_siswa')->nullable();
            $table->unsignedBigInteger('id_guru')->nullable();

            // Status akun
            $table->boolean('is_active')->default(true);

            // Laravel auth
            $table->rememberToken();
            $table->timestamps();

            // ========================
            // FOREIGN KEY
            // ========================
            $table->foreign('id_siswa')
                  ->references('id_siswa')
                  ->on('siswa')
                  ->onDelete('cascade');

            $table->foreign('id_guru')
                  ->references('id_guru')
                  ->on('guru')
                  ->onDelete('cascade');

            // ========================
            // INDEX
            // ========================
            $table->index('email');
            $table->index('role');
            $table->index('id_siswa');
            $table->index('id_guru');
        });

        // ========================
        // PASSWORD RESET TOKENS
        // ========================
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();

            // Index biar cepat
            $table->index('email');
        });

        // ========================
        // SESSIONS
        // ========================
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();

            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();

            // FK ke users
            $table->foreign('user_id')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');
        });

        // ========================
        // VALIDASI TAMBAHAN
        // ========================
        DB::statement("ALTER TABLE users ADD CONSTRAINT chk_role CHECK (role IN ('admin','audit','guru','siswa'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
