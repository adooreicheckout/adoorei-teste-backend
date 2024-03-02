<?php

namespace App\Providers;

use App\Database\Repositories\ProductsRepository;
use Illuminate\Support\ServiceProvider;
use Domain\Repositories\ProductsRepository as ProductsRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProductsRepositoryInterface::class,
            ProductsRepository::class
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
