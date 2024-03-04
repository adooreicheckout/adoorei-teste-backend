<?php

namespace App\Providers\Products;

use App\Repositories\Products\Contracts\ProductRepositoryContract;
use App\Repositories\Products\ProductRepository;
use Illuminate\Support\ServiceProvider;

class ProductsRepositoryProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ProductRepositoryContract::class,
            ProductRepository:: class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function provides()
    {
        return [
            ProductRepositoryContract::class
        ];
    }
}
