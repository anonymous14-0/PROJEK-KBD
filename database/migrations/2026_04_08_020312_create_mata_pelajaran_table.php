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
        Schema::create('mata_pelajaran', function (Blueprint $table) {
            $table->id('id_mapel');
            $table->string('kode_mapel')->unique(); // Tambahkan unique jika kode mapel tidak boleh sama
            $table->string('nama_mapel');
            $table->string('jurusan');
            
            // Relasi ke tabel guru
            // Pastikan tabel guru sudah dibuat di file migrasi sebelumnya
            $table->foreignId('id_guru')->constrained('guru', 'id_guru')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_pelajaran');
    }
};
