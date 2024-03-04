<?php

namespace App\Providers\Sales;

use App\Repositories\Sales\Contracts\SaleRepositoryContract;
use App\Repositories\Sales\SaleRepository;
use Illuminate\Support\ServiceProvider;

class SalesRepositoryProvider extends ServiceProvider
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
            SaleRepositoryContract::class,
            SaleRepository:: class
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
            SaleRepositoryContract::class
        ];
    }
}
