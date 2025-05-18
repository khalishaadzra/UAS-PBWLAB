<?php

namespace App\Http\Controllers;

use App\Models\Movie;   // Pastikan ini di-import
use App\Models\Review;  // Pastikan ini di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan ini di-import
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReviewController extends Controller
{
      use AuthorizesRequests; 
    // Anda mungkin ingin menerapkan middleware auth ke semua method di controller ini
    // Jika belum melakukannya di rute. Cara di rute lebih umum.
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Menyimpan review baru ke database.
     */
    public function store(Request $request, Movie $movie) // Menerima objek Movie karena Route Model Binding
    {
        // Validasi input dari form review
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',         // Rating wajib, antara 1-5
            'comment' => 'nullable|string|max:1000', // Komentar boleh kosong, maksimal 1000 karakter
        ]);

        // Dapatkan user yang sedang login
        $user = Auth::user();

        // Cek apakah user sudah pernah mereview film ini sebelumnya
        // Ini penting untuk mencegah user mereview berkali-kali (kecuali Anda mengizinkannya)
        $existingReview = $movie->reviews()->where('user_id', $user->id)->first();

        if ($existingReview) {
            // Jika sudah ada, mungkin update review yang ada atau beri pesan error
            // Untuk sekarang, kita beri pesan error dan kembali
            return back()->with('error', 'Anda sudah memberikan review untuk film ini. Anda bisa mengedit review Anda.');
            // Atau, jika ingin update:
            // $existingReview->update([
            //     'rating' => $request->rating,
            //     'comment' => $request->comment,
            // ]);
            // return back()->with('success', 'Review Anda berhasil diperbarui!');
        }

        // Buat review baru yang berelasi dengan movie dan user
        $movie->reviews()->create([
            'user_id' => $user->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            // movie_id akan otomatis terisi karena kita create melalui relasi $movie->reviews()
        ]);

        // Kembali ke halaman sebelumnya (halaman detail film) dengan pesan sukses
        return back()->with('success', 'Review Anda berhasil ditambahkan!');
    }

    // Tambahkan method lain seperti update() dan destroy() di sini jika belum
    public function update(Request $request, Review $review)
    {
        // Pastikan hanya pemilik review yang bisa update (Gunakan Policy)
        $this->authorize('update', $review);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review->update($request->only(['rating', 'comment']));

        return back()->with('success', 'Review berhasil diperbarui!');
    }

    public function destroy(Review $review)
    {
        // Pastikan hanya pemilik review yang bisa delete (Gunakan Policy)
        $this->authorize('delete', $review);

        $review->delete();
        return back()->with('success', 'Review berhasil dihapus.');
    }
}