<?php

namespace App\Providers;

use App\Interfaces\Repositories\ProductRepositoryInterface;
use App\Interfaces\Repositories\SaleProductRepositoryInterface;
use App\Interfaces\Repositories\SaleRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\SaleProductRepository;
use App\Repositories\SaleRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(SaleRepositoryInterface::class, SaleRepository::class);
        $this->app->bind(SaleProductRepositoryInterface::class, SaleProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
