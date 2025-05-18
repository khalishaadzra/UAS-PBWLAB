<?php

use App\Http\Controllers\MovieController; // Pastikan ini di-import
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Untuk cek login
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WatchlistController;
use App\Models\Movie;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Landing Awal (Jika pengguna belum login, arahkan ke halaman auth Anda)
Route::get('/', function () {
    if (Auth::check()) {
        // Jika sudah login, arahkan ke beranda atau dashboard
        return redirect()->route('beranda'); // Atau 'dashboard'
    }
    return view('pages.landing'); // Atau langsung ke 'pages.auth' jika landing tidak ada
})->name('landing');

// Halaman Login/Register Custom Anda
Route::get('/auth', function () {
    if (Auth::check()) {
        return redirect()->route('beranda'); // Atau 'dashboard'
    }
    return view('pages.auth'); // File Blade dengan slider Anda
})->name('page.auth');


// Rute yang dibuat Breeze untuk dashboard (bisa Anda gunakan atau ganti dengan /beranda)
Route::get('/dashboard', function () {
    return view('dashboard'); // View 'dashboard.blade.php' dari Breeze
})->middleware(['auth', 'verified'])->name('dashboard');

// Halaman Beranda Anda setelah login
Route::get('/beranda', [HomeController::class, 'index'])->middleware(['auth'])->name('beranda');

// Rute untuk Movies (CRUD)
Route::resource('movies', MovieController::class)->middleware(['auth']); // Semua rute movies dilindungi

// Rute untuk Watchlist
Route::get('/watchlist', function () {
    return view('pages.watchlist');
})->middleware(['auth'])->name('watchlist');

// Rute untuk Series
Route::get('/series', function () {
    $seriesItems = Movie::where('tipe', 'Series')
                       ->orderBy('created_at', 'desc')
                       ->paginate(15, ['*'], 'seriesPage');
    return view('pages.series', compact('seriesItems')); // <-- KIRIM DATA DI SINI
})->name('series.index')->middleware('auth');

// Rute untuk /desc (jika masih dipakai)
Route::get('/desc', function () {
    return view('pages.desc');
})->middleware(['auth'])->name('desc');

Route::post('/movies/{movie}/reviews', [ReviewController::class, 'store'])
    ->middleware(['auth']) // Hanya user yang login bisa membuat review
    ->name('reviews.store');


// Rute untuk mengupdate review yang sudah ada
Route::put('/reviews/{review}', [ReviewController::class, 'update'])
    ->middleware(['auth'])
    ->name('reviews.update');

// Rute untuk menghapus review
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('reviews.destroy');

Route::post('/watchlist/add/{movie}', [WatchlistController::class, 'add'])
    ->middleware(['auth'])
    ->name('watchlist.add');

// Rute untuk menampilkan halaman watchlist (Anda sudah punya ini mungkin)
Route::get('/watchlist', [WatchlistController::class, 'index']) // Arahkan ke controller jika ingin dinamis
    ->middleware(['auth'])
    ->name('watchlist');

// Rute untuk menghapus dari watchlist (contoh)
Route::delete('/watchlist/remove/{movie}', [WatchlistController::class, 'remove'])
    ->middleware(['auth'])
    ->name('watchlist.remove');

// Rute Profil dari Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ini akan meng-include semua rute autentikasi dari Breeze (login, register, logout, dll.)
require __DIR__.'/auth.php';