<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.landing');
});

Route::get('/home', function () {
    return view('pages.beranda');
});


Route::get('/home', function () {
    return view('pages.beranda');
});