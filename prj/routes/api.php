<?php

use Illuminate\Http\Request;
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

Route::apiResource('products', App\Http\Controllers\Api\ProdutosController::class)->names('api.products')->parameters([
    'products' => 'produto'
]);

Route::get('sales/cancel/{venda}', [App\Http\Controllers\Api\VendasController::class, 'cancelSale'])->name('api.sales.cencel');

Route::apiResource('sales', App\Http\Controllers\Api\VendasController::class)->names('api.sales')->parameters([
    'sales' => 'venda'
]);
