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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('products', 'ProdutosController')->names('api.products')->parameters([
    'products' => 'produto'
]);

Route::get('sales/cancel/{venda}', 'VendasController@cancelSale')->name('api.sales.cencel');

Route::apiResource('sales', 'VendasController')->names('api.sales')->parameters([
    'sales' => 'venda'
]);