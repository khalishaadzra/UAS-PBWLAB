<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            // Kolom ini bisa menyimpan path lokal (relatif dari public) atau URL internet lengkap
            $table->string('hero_video_path')->nullable()->after('poster_url'); // Atau posisi lain
            // Opsional: Tambahkan kolom boolean untuk menandai item mana yang jadi kandidat hero
            $table->boolean('is_hero_candidate')->default(false)->after('hero_video_path');
        });
    }

    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn('hero_video_path');
            $table->dropColumn('is_hero_candidate');
        });
    }
};