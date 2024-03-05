<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        //Repositories
        $this->app->bind(\App\Contracts\Repositories\Product::class, \App\Repositories\ProductRepository::class);
        $this->app->bind(\App\Contracts\Repositories\Sale::class, \App\Repositories\SaleRepository::class);

        //Services
        $this->app->bind(\App\Contracts\Services\Product::class, \App\Services\ProductService::class);
        $this->app->bind(\App\Contracts\Services\Sale::class, \App\Services\SaleService::class);

    }
}
