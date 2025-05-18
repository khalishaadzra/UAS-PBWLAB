<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware; // Pastikan ini di-import dengan benar

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        // Jika Breeze menambahkan 'then' untuk auth.php di sini, biarkan saja
        // Contoh:
        // then: function () {
        //     require __DIR__.'/../routes/auth.php';
        // }
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Baris yang sudah ada mungkin:
        // $middleware->web(append: [
        //     \App\Http\Middleware\HandleInertiaRequests::class,
        //     \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        // ]);

        // === TAMBAHKAN BARIS INI ===
        $middleware->redirectUsersTo('/beranda'); // Ganti '/beranda' dengan path yang Anda inginkan
        // ============================

        // Anda juga bisa menggunakan nama rute jika sudah didefinisikan:
        // $middleware->redirectUsersTo(fn ($request) => route('beranda'));

        // Jika Anda perlu mengatur redirect untuk tamu (pengguna yang belum login
        // ketika mencoba akses halaman terproteksi), Anda bisa menambahkan:
        // $middleware->redirectGuestsTo(fn ($request) => route('page.auth')); // Mengarah ke halaman auth custom Anda
        // Atau default Breeze biasanya sudah mengarah ke route('login')
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();