<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->string('nis')->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);

            // Kolom untuk menghubungkan siswa dengan tabel kelas
            $table->unsignedBigInteger('id_kelas');

            // Relasi (Foreign Key) ke tabel kelas
            $table->foreign('id_kelas')
                  ->references('id_kelas')
                  ->on('kelas')
                  ->onDelete('cascade');

            $table->index('nama_lengkap');
            $table->index('id_kelas');
            $table->timestamps();

            // Soft Delete
            $table->softDeletes();
        });

        if (DB::getDriverName() !== 'sqlite') {
            DB::statement(
                "ALTER TABLE siswa ADD CONSTRAINT chk_jk_siswa CHECK (jenis_kelamin IN ('L','P'))"
            );
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};