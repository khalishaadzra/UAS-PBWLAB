<?php

use Illuminate\Support\Facades\Route;

Route::get('/desc', function () {
    return view('desc');
});

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/', function () {
    return view('landing');
});
