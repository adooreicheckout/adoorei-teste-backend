<?php

namespace App\Providers\Products;

use App\Services\Products\Contracts\ProductServiceContract;
use App\Services\Products\ProductService;
use Illuminate\Support\ServiceProvider;

class ProductsServiceProvider extends ServiceProvider
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
            ProductServiceContract::class,
            ProductService:: class
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
            ProductServiceContract::class
        ];
    }
}
