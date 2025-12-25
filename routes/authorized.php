<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\PostController as Post;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\AdminController as Admin;
use App\Http\Controllers\auth\UserDashboardController as User;

Route::middleware('auth.login')->group(function () {
    Route::prefix('user')->group(function () {
        Route::resource('posts', Post::class)->except(['show', 'vote', 'like']);
        Route::resource('profile', ProfileController::class);
        Route::resource('dashboard', User::class);

        Route::get('saved', [Post::class, 'saved'])->name('posts.saved');
        Route::post('vote', [Post::class, 'voteAsync'])->name('posts.voteAsync');
        Route::post('toggle-save', [Post::class, 'toggleSaveAsync'])->name('posts.toggleSaveAsync');
        Route::post('clear-saved', [Post::class, 'clearSaved'])->name('posts.clearSaved');
    });
});
Route::middleware('auth.admin')->group(function () {
    Route::resource('admin', Admin::class);
});