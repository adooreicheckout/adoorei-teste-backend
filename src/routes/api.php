<?php

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

Route::group(['prefix' => 'products'], function () {
    Route::get('', [App\Http\Controllers\Api\ProductsController::class, 'index']);
});

Route::group(['prefix' => 'sales'], function () {
    Route::get('', [App\Http\Controllers\Api\SalesController::class, 'index']);
    Route::post('', [App\Http\Controllers\Api\SalesController::class, 'store']);
    Route::get('{id}', [App\Http\Controllers\Api\SalesController::class, 'show']);
    Route::put('{id}', [App\Http\Controllers\Api\SalesController::class, 'addProducts']);
    Route::patch('{id}', [App\Http\Controllers\Api\SalesController::class, 'cancel']);
});
