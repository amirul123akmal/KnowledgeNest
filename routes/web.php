<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\guest\LoginController as Login;
use App\Http\Controllers\guest\RegisterController as Register;
use App\Http\Controllers\HomeController as Home;
use App\Http\Controllers\auth\PostController as Post;

Route::resource('/', Home::class, ['names' => 'welcome']);

Route::resource('login', Login::class);
Route::resource('register', Register::class);
Route::post('/logout', [Login::class, 'logout'])->name('logout');
Route::get('/search', [Home::class, 'search'])->name('search');
Route::view('/aboutus', 'guest.aboutus')->name('aboutus');
Route::view('/joinus', 'guest.whyjoinus')->name('whyjoinus');

Route::get('/posts/{post}', [Post::class, 'show'])->name('posts.show');
Route::post('posts/{post}/vote', [Post::class, 'vote'])->name('posts.vote');
Route::post('posts/{post}/like', [Post::class, 'like'])->name('posts.like');
Route::post('posts/{post}/save', [Post::class, 'save'])->name('posts.save');
Route::post('posts/{post}/comment', [Post::class, 'storeComment'])->name('posts.comment.store');
Route::post('/comments/{comment}/reply', [Post::class, 'replyComment'])->name('comments.reply');
Route::post('/comments/{comment}/vote', [Post::class, 'voteComment'])->name('comments.vote');

use App\Http\Controllers\auth\GoogleController;

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');


include __DIR__ . '/authorized.php';
