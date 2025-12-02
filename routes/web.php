<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\guest\LoginController as Login;
use App\Http\Controllers\guest\RegisterController as Register;
use App\Http\Controllers\HomeController as Home;

Route::resource('/', Home::class);

Route::resource('login', Login::class);
Route::resource('register', Register::class);
Route::post('/logout', [Login::class, 'logout'])->name('logout');
