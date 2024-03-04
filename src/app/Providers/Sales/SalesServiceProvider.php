<?php

namespace App\Providers\Sales;

use App\Services\Sales\Contracts\SaleServiceContract;
use App\Services\Sales\SaleService;
use Illuminate\Support\ServiceProvider;

class SalesServiceProvider extends ServiceProvider
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
            SaleServiceContract::class,
            SaleService:: class
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
            SaleServiceContract::class
        ];
    }
}
