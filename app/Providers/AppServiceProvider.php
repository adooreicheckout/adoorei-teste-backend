<?php

namespace App\Providers;

use App\Database\Repositories\Eloquent\EloquentProductsRepository;
use Illuminate\Support\ServiceProvider;
use Domain\Repositories\ProductsRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProductsRepository::class,
            EloquentProductsRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
