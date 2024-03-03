<?php

use App\Http\Controllers\ProductsListController;
use App\Http\Controllers\SalesListController;
use Illuminate\Http\Request;
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

Route::group(['prefix' =>  'sale'], function() {
    Route::get('/', SalesListController::class)->name('sales.all');
});
