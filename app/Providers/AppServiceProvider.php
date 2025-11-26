<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Gate;

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
        // Define un Gate llamado 'view-profile'
        Gate::define('view-profile', function ($user) {
            // En este caso simple, solo verifica si el usuario existe (está logueado).
            //return (bool) $user;
            // En casos reales, podrías poner lógica más compleja aquí (ej: $user->isAdmin).
            return (bool) $user && $user->is_admin;
        });
    }
}
