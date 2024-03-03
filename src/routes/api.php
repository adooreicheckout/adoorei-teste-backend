<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
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

Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/{id}', [ProductController::class, 'show'])->name('products.show');
});

Route::group(['prefix' => 'sales'], function () {
    Route::get('/', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/{id}', [SaleController::class, 'show'])->name('sales.show');
    Route::post('/', [SaleController::class, 'store'])->name('sales.store');
    Route::post('/{id}', [SaleController::class, 'update'])->name('sales.update');
    Route::delete('/{id}', [SaleController::class, 'destroy'])->name('sales.destroy');
});
