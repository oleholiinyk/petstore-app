<?php

namespace App\Providers;

use App\Contracts\PetStoreProvider;
use App\Providers\PetStoreProviders\Pet;
use Illuminate\Foundation\Application;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PetStoreProvider::class, function (Application $app) {
            return new Pet();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
