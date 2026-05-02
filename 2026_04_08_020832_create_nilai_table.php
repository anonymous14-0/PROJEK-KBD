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
        Schema::create('nilai', function (Blueprint $table) {
            // Primary Key
            $table->id('id_nilai');

            // Relasi ke siswa
            $table->unsignedBigInteger('id_siswa');

            $table->foreign('id_siswa')
                  ->references('id_siswa')
                  ->on('siswa')
                  ->onDelete('cascade');

            // Relasi ke mata pelajaran
            $table->unsignedBigInteger('id_mapel');

            $table->foreign('id_mapel')
                  ->references('id_mapel')
                  ->on('mata_pelajaran')
                  ->onDelete('cascade');

            // Nilai
            $table->integer('nilai_uts');
            $table->integer('nilai_uas');

            $table->string('semester');       // contoh: ganjil/genap
            $table->string('tahun_ajaran');   // contoh: 2025/2026

            // Index (biar query cepat)
            $table->index('id_siswa');
            $table->index('id_mapel');

            // Cegah duplikasi nilai (1 siswa 1 mapel 1 semester 1 tahun)
            $table->unique(['id_siswa', 'id_mapel', 'semester', 'tahun_ajaran']);

            // Timestamps
            $table->timestamps();
        });

        // Optional: validasi nilai (MySQL 8+)
        DB::statement("ALTER TABLE nilai ADD CONSTRAINT chk_nilai_uts CHECK (nilai_uts BETWEEN 0 AND 100)");
        DB::statement("ALTER TABLE nilai ADD CONSTRAINT chk_nilai_uas CHECK (nilai_uas BETWEEN 0 AND 100)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
