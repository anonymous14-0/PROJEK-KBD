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
            // Primary Key
            $table->id('id_log');

            // Relasi ke users
            $table->unsignedBigInteger('id_user');

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');

            // Aktivitas yang dilakukan user
            $table->text('aktivitas');

            // Optional tambahan (biar lebih informatif)
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();

            // Index (biar cepat saat filter log per user)
            $table->index('id_user');

            // Timestamps
            $table->timestamps();
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
