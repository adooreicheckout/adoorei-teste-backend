<?php

use App\Http\Controllers\ProductsListController;
use App\Http\Controllers\SalesListController;
use App\Http\Controllers\SalesStoreController;
use App\Http\Controllers\SaleCancelController;
use App\Http\Controllers\SaleConsultController;
use App\Http\Controllers\SaleUpdateProductsController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' =>  'product'], function() {
    Route::get('/', ProductsListController::class)->name('products.all');
});

Route::group(['prefix' =>  'sales'], function() {
    Route::get('/', SalesListController::class)->name('sales.all');
    Route::post('/', SalesStoreController::class)->name('sales.store');
    Route::get('/{sale_id}', SaleConsultController::class)->name('sales.getById');
    Route::delete('/{sale_id}', SaleCancelController::class)->name('sales.cancel');
    Route::put('/{sale_id}', SaleUpdateProductsController::class)->name('sales.newProduct');
});
