<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guru', function (Blueprint $table) {
            // Membuat Primary Key dengan nama id_guru
            $table->id('id_guru');

            // Kolom nip dibuat unik agar tidak ada guru dengan NIP yang sama
            $table->string('nip')->unique();
            $table->string('nama_lengkap');

            // Enum membatasi input hanya 'L' (Laki-laki) atau 'P' (Perempuan)
            $table->enum('jenis_kelamin', ['L', 'P']);

            // Membuat index pada nama agar proses pencarian (search) lebih cepat
            $table->index('nama_lengkap');

            // Otomatis membuat kolom created_at dan updated_at
            $table->timestamps();

            // Fitur Soft Delete: Membuat kolom deleted_at agar data tidak hilang permanen
            $table->softDeletes();
        });

        // Validasi database tingkat lanjut untuk memastikan tidak ada data gender selain L/P
        DB::statement("ALTER TABLE guru ADD CONSTRAINT chk_jk_guru CHECK (jenis_kelamin IN ('L','P'))");
    }

    public function down(): void
    {
        // Menghapus tabel jika perintah php artisan migrate:rollback dijalankan
        Schema::dropIfExists('guru');
    }
};
