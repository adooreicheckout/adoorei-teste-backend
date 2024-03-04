<?php

namespace App\Providers\SaleItems;

use App\Repositories\SaleItems\Contracts\SaleItemsRepositoryContract;
use App\Repositories\SaleItems\SaleItemsRepository;
use Illuminate\Support\ServiceProvider;

class SaleItemsRepositoryProvider extends ServiceProvider
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
            SaleItemsRepositoryContract::class,
            SaleItemsRepository:: class
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
            SaleItemsRepositoryContract::class
        ];
    }
}
