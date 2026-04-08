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
        Schema::create('aktivitas_log', function (Blueprint $table) {
            $table->id('id_log');
            // Menghubungkan ke tabel users menggunakan id_user
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->text('aktivitas');
            // Mengisi waktu otomatis saat log dibuat
            $table->timestamp('created_at')->useCurrent(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas_log');
    }
};