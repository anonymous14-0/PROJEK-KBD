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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id('id_nilai');
            
            // Relasi ke tabel siswa
            $table->foreignId('id_siswa')->constrained('siswa', 'id_siswa')->onDelete('cascade');
            
            // Relasi ke tabel mata_pelajaran
            $table->foreignId('id_mapel')->constrained('mata_pelajaran', 'id_mapel')->onDelete('cascade');
            
            $table->integer('nilai_uts');
            $table->integer('nilai_uas');
            $table->string('semester');
            $table->string('tahun_ajaran');
            
            $table->timestamps(); // Menambahkan created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};