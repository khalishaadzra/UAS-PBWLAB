<?php

use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
Route::get('/', function () {
    return view('pages.landing');
=======
Route::get('/desc', function () {
    return view('desc');
});

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/', function () {
    return view('landing');
>>>>>>> 99e271434a49a9ec262daf5ac3e814ba19b2c920
});

Route::get('/home', function () {
    return view('pages.beranda');
});

