<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resource('sales', SaleController::class)->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

Route::resource('products', ProductsController::class)->only([
    'index'
]);
