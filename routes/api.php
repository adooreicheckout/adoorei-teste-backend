<?php

use App\Http\Controllers\ProductController;
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

Route::prefix('/product')->group(function () {
    Route::get('/', [ProductController::class, 'list']);
});

Route::prefix('/sale')->group(function () {
    //Lembrar de tentar baixar o projeto ao criar o container no dockerfile
    Route::get('/', [SaleController::class, 'list']);
    Route::post('/', [SaleController::class, 'create']);
});