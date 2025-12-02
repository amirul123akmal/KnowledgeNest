<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\guest\LoginController as Login;
use App\Http\Controllers\guest\RegisterController as Register;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('login', Login::class);
Route::resource('register', Register::class);