<?php

use App\Http\Controllers\Api\Sale\SaleController;
use Illuminate\Support\Facades\Route;

Route::controller(SaleController::class)->group(function () {
    Route::get('/', [SaleController::class, 'index']);
    Route::get('/{id}', [SaleController::class, 'show']);

    Route::delete('/{id}', [SaleController::class, 'destroy']);

    Route::post('/', [SaleController::class, 'store']);

    Route::put('/{id}/cancel', [SaleController::class, 'cancel']);
    Route::put('/{id}/add/products', [SaleController::class, 'addProducts']);
});
