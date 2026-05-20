<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('guru', function (Blueprint $table) {
            $table->string('nip_hash', 64)->nullable()->after('nip')->unique();
        });

        Schema::table('siswa', function (Blueprint $table) {
            $table->string('nis_hash', 64)->nullable()->after('nis')->unique();
        });
    }

    public function down(): void
    {
        Schema::table('guru', function (Blueprint $table) {
            $table->dropUnique(['nip_hash']);
            $table->dropColumn('nip_hash');
        });

        Schema::table('siswa', function (Blueprint $table) {
            $table->dropUnique(['nis_hash']);
            $table->dropColumn('nis_hash');
        });
    }
};
