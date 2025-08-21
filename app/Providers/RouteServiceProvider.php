<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/dashboard';

    public function boot(): void
    {
        $this->routes(function () {
            // Web routes
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Homeowner routes
            Route::middleware(['web', 'auth', 'verified', 'role:homeowner'])
                ->prefix('homeowner')
                ->name('homeowner.')
                ->group(base_path('routes/homeowner.php'));

            // Officer routes
            Route::middleware(['web', 'auth', 'verified', 'role:officer'])
                ->prefix('officer')
                ->name('officer.')
                ->group(base_path('routes/officer.php'));

            // Admin routes
            Route::middleware(['web', 'auth', 'verified', 'role:admin'])
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));
        });
    }
}
