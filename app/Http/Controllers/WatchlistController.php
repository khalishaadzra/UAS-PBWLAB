<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Jika Anda memiliki model WatchlistItem terpisah, Anda mungkin tidak memerlukannya
// jika menggunakan relasi many-to-many langsung dengan Movie.

class WatchlistController extends Controller
{
    // Middleware akan diterapkan pada RUTE, jadi constructor ini tidak lagi diperlukan untuk itu.
    // public function __construct()
    // {
    //     // $this->middleware('auth'); // Pindahkan ke definisi rute
    // }

    /**
     * Menampilkan item watchlist pengguna.
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            // Seharusnya tidak pernah sampai sini jika rute dilindungi middleware 'auth'
            return redirect()->route('login');
        }

        // Asumsi Anda memiliki relasi bernama 'watchlist' di model User
        // yang mengembalikan koleksi Movie.
        // public function watchlist() {
        //     return $this->belongsToMany(Movie::class, 'user_movie_watchlist', 'user_id', 'movie_id')
        //                ->withPivot('status', 'created_at') // Ambil juga status dan kapan ditambahkan
        //                ->orderBy('pivot_created_at', 'desc'); // Urutkan berdasarkan kapan ditambahkan
        // }
        $watchlistItems = $user->watchlist()->paginate(10); // Sesuaikan jumlah paginasi

        return view('pages.watchlist', compact('watchlistItems'));
    }

    /**
     * Menambahkan film ke watchlist pengguna.
     */
    public function add(Request $request, Movie $movie)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menambahkan ke watchlist.');
        }

        // Cek apakah film sudah ada di watchlist
        if ($user->watchlist()->where('movie_id', $movie->id)->exists()) {
            return back()->with('info', $movie->title . ' sudah ada di watchlist Anda.');
        }

        // Tambahkan film ke watchlist.
        // Jika tabel pivot 'user_movie_watchlist' memiliki kolom 'status', Anda bisa set nilai default.
        $user->watchlist()->attach($movie->id, ['status' => 'Belum nonton']); // Contoh set status default

        return back()->with('success', $movie->title . ' berhasil ditambahkan ke watchlist!');
    }

    /**
     * Menghapus film dari watchlist pengguna.
     */
    public function remove(Request $request, Movie $movie)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $user->watchlist()->detach($movie->id);

        return back()->with('success', $movie->title . ' berhasil dihapus dari watchlist.');
    }

    /**
     * Mengupdate status film di watchlist pengguna (untuk AJAX).
     */
    public function updateStatus(Request $request, Movie $movie)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $request->validate([
            'status' => 'required|string|in:Belum nonton,Sedang nonton,Selesai nonton',
        ]);

        // Cek apakah film ada di watchlist user sebelum update
        if ($user->watchlist()->where('movie_id', $movie->id)->exists()) {
            // Update status di tabel pivot
            $user->watchlist()->updateExistingPivot($movie->id, ['status' => $request->status]);

            return response()->json(['success' => 'Status watchlist untuk ' . $movie->title . ' berhasil diperbarui!']);
        }

        return response()->json(['error' => 'Film tidak ditemukan di watchlist Anda.'], 404);
    }
}