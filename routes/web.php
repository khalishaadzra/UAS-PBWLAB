<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.landing');
});

Route::get('/beranda', function () {
    return view('pages.beranda');
});

Route::get('/auth', function () {
    return view('pages.auth');
});
