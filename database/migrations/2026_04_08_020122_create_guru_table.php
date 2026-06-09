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

            // Hanya menerima nilai L atau P
            $table->enum('jenis_kelamin', ['L', 'P']);

            // Index untuk mempercepat pencarian
            $table->index('nama_lengkap');

            // created_at dan updated_at
            $table->timestamps();

            // Soft delete
            $table->softDeletes();
        });

        // SQLite tidak mendukung ALTER TABLE ADD CONSTRAINT
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement(
                "ALTER TABLE guru ADD CONSTRAINT chk_jk_guru CHECK (jenis_kelamin IN ('L','P'))"
            );
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};