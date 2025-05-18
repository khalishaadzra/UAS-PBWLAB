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
        Schema::table('movies', function (Blueprint $table) {
            // Asumsi 'poster_url' sudah ditambahkan oleh migrasi sebelumnya dan 'genre' adalah kolom terakhir sebelum ini
            // Jika 'description' BUKAN untuk Sinopsis, tambahkan baris ini:
            // $table->text('sinopsis')->nullable()->after('description');

            $table->string('penulis')->nullable()->after('sutradara'); // Contoh posisi setelah sutradara
            $table->string('negara')->nullable()->after('penulis');
            $table->string('bahasa')->nullable()->after('negara');
            $table->text('aktor_utama')->nullable()->after('genre'); // Menggunakan text agar bisa panjang
            $table->string('tipe')->nullable()->after('genre'); // Atau sesuaikan 'after' dengan kolom terakhir sebelum poster_url jika sudah ada
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            // Urutan dropColumn tidak terlalu penting, tapi baiknya konsisten
            // if (Schema::hasColumn('movies', 'sinopsis')) { // Cek jika ada sebelum drop, jika kondisional
            //     $table->dropColumn('sinopsis');
            // }
            $table->dropColumn('penulis');
            $table->dropColumn('negara');
            $table->dropColumn('bahasa');
            $table->dropColumn('aktor_utama');
            $table->dropColumn('tipe');
        });
    }
};