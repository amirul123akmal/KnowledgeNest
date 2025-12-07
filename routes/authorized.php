<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\PostController as Post;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\AdminController as Admin;

Route::middleware('auth.login')->group(function () {
    Route::prefix('user')->group(function () {
        Route::resource('posts', Post::class)->except(['show', 'vote', 'like']);
        Route::resource('profile', ProfileController::class);
    });
});
Route::middleware('auth.admin')->group(function () {
    Route::resource('admin', Admin::class);
});