<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Tambahkan ini untuk Auth::check() dan Auth::id()

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $movies = Movie::where('tipe', 'Movie') // Filter berdasarkan kolom 'tipe' bernilai 'Movie'
                       ->orderBy('created_at', 'desc')
                       ->paginate(15); // Atau jumlah paginasi yang Anda inginkan
        return view('pages.movie', compact('movies'));
    }

    public function indexSeries()
    {
        $seriesItems = Movie::where('tipe', 'Series') // Filter berdasarkan tipe 'Series'
                           ->orderBy('created_at', 'desc')
                           ->paginate(15, ['*'], 'seriesPage'); // Paginasi dengan nama parameter halaman berbeda

        // Kita akan membuat view baru untuk series atau menggunakan view yang sama dengan parameter berbeda
        return view('pages.series', compact('seriesItems'));
        // Atau jika Anda ingin menggunakan view 'pages.movie' yang sama:
        // return view('pages.movie', ['movies' => $seriesItems, 'pageTitle' => 'Daftar Series']);
    }
    
    /**
     * Show the form for creating a new resource.
     * Fungsi ini tidak lagi Anda gunakan jika tombol "Tambah Film Baru" dihilangkan.
     * Tapi tidak apa-apa tetap ada.
     */
    public function create()
    {
        return view('pages.movie-create');
    }

    /**
     * Store a newly created resource in storage.
     * Fungsi ini tidak lagi Anda gunakan jika tombol "Tambah Film Baru" dihilangkan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            // Ganti 'director' dan 'year' dengan nama kolom yang benar jika berbeda di DB
            // (misal 'sutradara' dan 'tahun_rilis')
            'director' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1800|max:' . (date('Y') + 5),
            // Ganti 'description' dengan 'sinopsis' jika itu nama kolom Anda
            'description' => 'nullable|string',
            'genre' => 'nullable|string|max:100',
            // Tambahkan validasi untuk field baru dari Seeder jika form create masih dipakai
            'penulis' => 'nullable|string|max:255',
            'negara' => 'nullable|string|max:255',
            'bahasa' => 'nullable|string|max:255',
            'aktor_utama' => 'nullable|string',
            'tipe' => 'nullable|string|max:100',
            'poster_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('_token');

        if ($request->hasFile('poster_url')) {
            $image = $request->file('poster_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/posters', $imageName);
            $data['poster_url'] = 'posters/' . $imageName;
        } else {
            $data['poster_url'] = null;
        }

        // Pastikan semua field di $data ada di $fillable model Movie
        Movie::create($data);

        return redirect()->route('movies.index')->with('success', 'Film berhasil ditambahkan!');
    }

    /**
     * Display the specified resource. (Halaman Detail Film)
     */
    public function show(Movie $movie) // Route Model Binding sudah mengambil $movie
    {
        // Mengambil review untuk film ini, dengan informasi user yang membuat review
        // Pastikan relasi 'reviews' sudah ada di model Movie
        // dan relasi 'user' sudah ada di model Review
        $reviews = $movie->reviews()
                         ->with('user') // Eager load data user
                         ->latest()     // Urutkan dari yang terbaru
                         ->paginate(5, ['*'], 'reviewsPage'); // Paginasi review, beri nama 'reviewsPage' agar tidak konflik jika ada paginasi lain

        // Hitung rata-rata rating
        // Pastikan method averageRating() ada di model Movie atau hitung manual
        $averageRating = round($movie->averageRating(), 1);
        // Atau jika method tidak ada: $averageRating = round($movie->reviews()->avg('rating'), 1);

        $userHasReviewed = false;
        $userReview = null;

        if (Auth::check()) { // Cek apakah ada pengguna yang login
            // Cek apakah user yang sedang login sudah pernah mereview film ini
            $userReview = $movie->reviews()->where('user_id', Auth::id())->first();
            if ($userReview) {
                $userHasReviewed = true;
            }
        }

        // Kirim semua variabel yang dibutuhkan ke view
        return view('pages.desc', compact( // Pastikan nama view 'pages.desc' benar
            'movie',
            'reviews',
            'averageRating',
            'userHasReviewed',
            'userReview'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     * Fungsi ini tidak lagi Anda gunakan jika tombol "Edit" dihilangkan dari daftar film.
     */
    public function edit(Movie $movie)
    {
        return view('pages.movie-edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     * Fungsi ini tidak lagi Anda gunakan jika tombol "Edit" dihilangkan dari daftar film.
     */
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1800|max:' . (date('Y') + 5),
            'description' => 'nullable|string', // atau 'sinopsis'
            'genre' => 'nullable|string|max:100',
            'penulis' => 'nullable|string|max:255',
            'negara' => 'nullable|string|max:255',
            'bahasa' => 'nullable|string|max:255',
            'aktor_utama' => 'nullable|string',
            'tipe' => 'nullable|string|max:100',
            'poster_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('poster_url')) {
            if ($movie->poster_url) {
                Storage::delete('public/' . $movie->poster_url);
            }
            $image = $request->file('poster_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/posters', $imageName);
            $data['poster_url'] = 'posters/' . $imageName;
        }
        // Jika tidak ada file baru, $data['poster_url'] tidak akan di-set,
        // sehingga $movie->update($data) tidak akan mengubah poster_url yang ada.

        $movie->update($data);

        return redirect()->route('movies.index')->with('success', 'Film berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * Fungsi ini tidak lagi Anda gunakan jika tombol "Hapus" dihilangkan dari daftar film.
     */
    public function destroy(Movie $movie)
    {
        if ($movie->poster_url) {
            Storage::delete('public/' . $movie->poster_url);
        }
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Film berhasil dihapus!');
    }
}