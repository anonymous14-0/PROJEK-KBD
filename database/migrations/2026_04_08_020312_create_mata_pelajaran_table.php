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
        Schema::create('mata_pelajaran', function (Blueprint $table) {
            // Primary Key
            $table->id('id_mapel');

            // Data utama
            $table->string('kode_mapel')->unique();
            $table->string('nama_mapel');
            $table->string('jurusan');

            // Relasi ke guru
            $table->unsignedBigInteger('id_guru');

            $table->foreign('id_guru')
                  ->references('id_guru')
                  ->on('guru')
                  ->onDelete('cascade');

            // Index
            $table->index('nama_mapel');
            $table->index('jurusan');
            $table->index('id_guru');

            // Timestamps
            $table->timestamps();
        });

        // Optional: cegah duplikasi mapel dalam jurusan yang sama
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement(
                "ALTER TABLE mata_pelajaran ADD CONSTRAINT unique_mapel_jurusan UNIQUE (nama_mapel, jurusan)"
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_pelajaran');
    }
};