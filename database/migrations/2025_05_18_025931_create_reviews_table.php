<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key ke tabel 'users'
            $table->foreignId('movie_id')->constrained()->onDelete('cascade'); // Foreign key ke tabel 'movies'
            $table->unsignedTinyInteger('rating'); // Rating (misal, 1-5 atau 1-10)
            $table->text('comment')->nullable();   // Komentar review, boleh kosong
            $table->timestamps(); // created_at dan updated_at

            // Opsional: Unique constraint agar satu user hanya bisa mereview satu film sekali
            // $table->unique(['user_id', 'movie_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};