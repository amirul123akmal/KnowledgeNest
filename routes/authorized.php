<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\PostController as Post;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\AdminController as Admin;
use App\Http\Controllers\auth\UserDashboardController as User;
use App\Http\Controllers\auth\ChatController as Chat;

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

    Route::middleware('throttle:chat')->group(function () {
        Route::post('chat', [Chat::class, 'chat'])->name('chat');
        Route::post('chat/clear', [Chat::class, 'clear'])->name('chat.clear');
    });
});
Route::middleware('auth.admin')->group(function () {
    Route::resource('admin/posts', \App\Http\Controllers\admin\PostController::class, ['names' => 'admin.posts']);
    Route::resource('admin', Admin::class);
    Route::get('users', [Admin::class, 'users'])->name('users.index');
    Route::get('users/{user}', [Admin::class, 'show'])->name('users.show');
    Route::get('users/{user}/edit', [Admin::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [Admin::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [Admin::class, 'destroy'])->name('users.destroy');

    // Settings
    Route::get('settings', [Admin::class, 'settings'])->name('admin.settings');
    Route::put('settings', [Admin::class, 'updateSettings'])->name('admin.settings.update');
});