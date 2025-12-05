<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\guest\LoginController as Login;
use App\Http\Controllers\guest\RegisterController as Register;
use App\Http\Controllers\HomeController as Home;
use App\Http\Controllers\auth\PostController as Post;

Route::resource('/', Home::class);

Route::resource('login', Login::class);
Route::resource('register', Register::class);
Route::post('/logout', [Login::class, 'logout'])->name('logout');

Route::get('/posts/{post}', [Post::class, 'show'])->name('posts.show');
Route::post('posts/{post}/vote', [Post::class, 'vote'])->name('posts.vote');
Route::post('posts/{post}/like', [Post::class, 'like'])->name('posts.like');

include __DIR__ . '/authorized.php';
