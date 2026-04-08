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
        Schema::create('siswa', function (Blueprint $table) {
    $table->id('id_siswa');
    $table->string('nis')->unique();
    $table->string('nama_lengkap');
    $table->enum('jenis_kelamin', ['L', 'P']);
    $table->foreignId('id_kelas')->constrained('kelas', 'id_kelas');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
