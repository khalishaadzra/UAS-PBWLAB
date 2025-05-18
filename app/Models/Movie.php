<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambahkan ini jika Anda berencana menggunakan Factory
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory; // Tambahkan ini jika Anda menggunakan Factory

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // protected $table = 'movies'; // Ini tidak wajib jika nama tabel Anda adalah bentuk plural dari nama model (Movie -> movies)

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',        // Dari create_movies_table
        'director',     // Dari create_movies_table
        'year',         // Dari create_movies_table (pastikan nama kolom di DB 'year' atau 'tahun_rilis')
        'description',  // Dari create_movies_table (jika ini untuk Sinopsis, atau nama kolom sinopsis Anda)
        'genre',        // Dari create_movies_table
        'poster_url',   // Dari add_poster_url_to_movies_table

        // Kolom-kolom baru dari migrasi add_remaining_fields_to_movies_table
        // 'sinopsis',    // Jika Anda memiliki kolom 'sinopsis' terpisah dari 'description'
        'penulis',
        'negara',
        'bahasa',
        'aktor_utama',
        'tipe',
        'hero_video_path',
        'is_hero_candidate',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'year' => 'integer', // Contoh: jika Anda ingin 'year' selalu menjadi integer saat diambil
        // 'release_date' => 'date', // Jika Anda punya kolom tanggal dan ingin di-cast sebagai objek Carbon Date
    ];

    /**
     * Indicates if the model should be timestamped.
     * Laravel otomatis mengelola created_at dan updated_at jika kolomnya ada
     * dan properti ini true (default).
     *
     * @var bool
     */
    // public $timestamps = true; // Ini adalah default, jadi tidak perlu didefinisikan secara eksplisit kecuali ingin diubah
    // Relasi: Satu Movie memiliki banyak Review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Method untuk menghitung rata-rata rating
    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
}