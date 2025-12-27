<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();

        Blade::directive('onload', function () {
            return "window.onload = function () {";
        });

        // End directive
        Blade::directive('endonload', function () {
            return "};";
        });

        RateLimiter::for('chat', function (Request $request) {
            $userId = optional($request->user())->id ?: $request->ip();
            // e.g. 10 requests per minute per user
            return Limit::perMinute(10)->by($userId);
        });
    }
}
