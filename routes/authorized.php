<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\PostController;
use App\Http\Controllers\ProfileController;

Route::middleware('auth.login')->group(function () {
    Route::prefix('user')->group(function () {
        Route::resource('posts', PostController::class)->except(['show']);
        Route::resource('profile', ProfileController::class);
    });
});