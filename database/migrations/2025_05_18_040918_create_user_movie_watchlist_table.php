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
        Schema::create('user_movie_watchlist', function (Blueprint $table) {
            $table->id(); // Primary key untuk tabel pivot ini (opsional, bisa juga primary key komposit)

            // Foreign key untuk user_id yang merujuk ke tabel 'users'
            $table->foreignId('user_id')
                  ->constrained('users') // Nama tabel users
                  ->onDelete('cascade');  // Jika user dihapus, entri watchlist terkait juga dihapus

            // Foreign key untuk movie_id yang merujuk ke tabel 'movies'
            $table->foreignId('movie_id')
                  ->constrained('movies') // Nama tabel movies
                  ->onDelete('cascade');   // Jika movie dihapus, entri watchlist terkait juga dihapus

            // Kolom untuk status tonton (misalnya: Belum nonton, Sedang nonton, Selesai nonton)
            $table->string('status')->default('Belum nonton');

            $table->timestamps(); // Kolom created_at dan updated_at (kapan item ditambahkan/diupdate di watchlist)

            // Opsional tapi sangat direkomendasikan:
            // Membuat kombinasi user_id dan movie_id unik untuk mencegah duplikasi.
            // Seorang user tidak bisa menambahkan film yang sama ke watchlist lebih dari sekali.
            $table->unique(['user_id', 'movie_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_movie_watchlist');
    }
};