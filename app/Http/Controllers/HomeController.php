<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Data untuk Hero Carousel (sudah termasuk data untuk overlay)
        $heroItems = Movie::whereNotNull('poster_url') // Pastikan ada poster jika video tidak ada/fallback
                           ->orderBy('created_at', 'desc')
                           ->take(3) // Jumlah slide video Anda
                           ->get(['id', 'title', 'sinopsis', 'poster_url', 'tipe']); // Ambil semua field yang mungkin dibutuhkan

        $trendingItems = Movie::where('tipe', 'Trending')
                               ->whereNotNull('poster_url')
                               ->orderBy('created_at', 'desc')
                               ->take(5)
                               ->get();

        $mostItems = Movie::where('tipe', 'Most')
                                    ->whereNotNull('poster_url')
                                    ->orderBy('tahun_rilis', 'asc')
                                    ->take(5)
                                    ->get();
        if ($mostItems->isEmpty()) { // Fallback
            $mostItems = Movie::where('tahun_rilis', '>', now()->year)
                                    ->whereNotNull('poster_url')
                                    ->orderBy('tahun_rilis', 'asc')
                                    ->take(5)
                                    ->get();
        }

        $popularItems = Movie::where('tipe', 'Populer')
                               ->whereNotNull('poster_url')
                               ->orderBy('created_at', 'desc')
                               ->take(5)
                               ->get();
        if ($popularItems->isEmpty()) { // Fallback
             $popularItems = Movie::orderBy('created_at', 'asc')->whereNotNull('poster_url')->take(5)->get();
        }

        $topRatedItems = Movie::where('tipe', 'Top Rate')
                              ->whereNotNull('poster_url')
                              ->orderBy('created_at', 'desc')
                              ->take(5)
                              ->get();
         if ($topRatedItems->isEmpty()) { // Fallback
             $topRatedItems = Movie::inRandomOrder()->whereNotNull('poster_url')->take(5)->get();
        }

        return view('pages.beranda', compact(
            'heroItems', // <-- KIRIM INI
            'trendingItems',
            'mostItems', // Anda menggunakan ini di Blade, jadi pastikan ini yang dikirim
            'popularItems',
            'topRatedItems'
        ));
    }
}