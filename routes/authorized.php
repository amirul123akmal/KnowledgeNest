<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\PostController;

Route::middleware('auth.login')->group(function () {
    Route::prefix('user')->group(function () {
        Route::resource('posts', PostController::class);
    });
});