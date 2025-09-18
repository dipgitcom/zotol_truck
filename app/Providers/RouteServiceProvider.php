<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Load API routes
        Route::group([
            'middleware' => 'api',
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });

        // Load Web routes
        Route::group([
            'middleware' => 'web',
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }
}
