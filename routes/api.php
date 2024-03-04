<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductsController::class, 'index']);

Route::get('/sales', [SalesController::class, 'index']);
Route::get('/sales/{id}', [SalesController::class, 'show']);
Route::get('/sales/status/complete', [SalesController::class, 'listCompleteSales']);
Route::post('/sales', [SalesController::class, 'store']);
Route::patch('/sales/{id}/cancel', [SalesController::class, 'cancelSale']);
Route::post('/sales/{id}/add-products', [SalesController::class, 'addProductsToExistingSale']);

