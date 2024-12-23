<?php

namespace App\Providers;

use App\Services\AuthService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(AuthService::class, function ($app) {
            return new AuthService();
        });
    }

    public function boot()
    {
        Blade::directive('isAdmin', function () {
            return "<?php if(auth()->check() && auth()->user()->is_admin): ?>";
        });

        Blade::directive('endIsAdmin', function () {
            return "<?php endif; ?>";
        });
        Blade::directive('isNotAdmin', function () {
            return "<?php if(auth()->check() && !auth()->user()->is_admin): ?>";
        });
        
        Blade::directive('endIsNotAdmin', function () {
            return "<?php endif; ?>";
        });
    }
}