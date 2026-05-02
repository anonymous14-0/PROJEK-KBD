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
        Schema::create('siswa', function (Blueprint $table) {
            // Primary Key
            $table->id('id_siswa');

            // Data utama
            $table->string('nis')->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);

            // Relasi ke kelas
            $table->unsignedBigInteger('id_kelas');

            $table->foreign('id_kelas')
                  ->references('id_kelas')
                  ->on('kelas')
                  ->onDelete('cascade');

            // Index (biar query cepat)
            $table->index('nama_lengkap');
            $table->index('id_kelas');

            // Timestamps
            $table->timestamps();
        });

        // Optional: validasi tambahan (MySQL 8+)
        DB::statement("ALTER TABLE siswa ADD CONSTRAINT chk_jk_siswa CHECK (jenis_kelamin IN ('L','P'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
