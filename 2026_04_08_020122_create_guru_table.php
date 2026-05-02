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
        Schema::create('guru', function (Blueprint $table) {
            // Primary Key
            $table->id('id_guru');

            // Data utama
            $table->string('nip')->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);

            // Index (biar pencarian cepat)
            $table->index('nama_lengkap');

            // Timestamps
            $table->timestamps();
        });

        // Optional: validasi tambahan (MySQL 8+)
        DB::statement("ALTER TABLE guru ADD CONSTRAINT chk_jk_guru CHECK (jenis_kelamin IN ('L','P'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};
