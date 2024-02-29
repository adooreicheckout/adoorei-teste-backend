<?php

namespace App\Providers;

use App\Domain\Orders\Repositories\EloquentOrderRepository;
use App\Domain\Orders\Repositories\OrderRepository;
use Illuminate\Support\ServiceProvider;
use App\Domain\Product\Repositories\ProductRepository;
use App\Domain\Product\Repositories\EloquentProductRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepository::class, EloquentProductRepository::class);
        $this->app->bind(OrderRepository::class, EloquentOrderRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
