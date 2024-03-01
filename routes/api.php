<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/cellphones', ['App\Http\Controllers\CellphonesController', 'index'])->name('cellphones.index');

Route::prefix('sales')->group(function (){
   Route::post('/',['App\Http\Controllers\SaleController', 'store'])->name('sale.create');
   Route::get('/', ['App\Http\Controllers\SaleController', 'index'])->name('sale.index');
   Route::get('/{id}',['App\Http\Controllers\SaleController', 'show'])->name('sale.show');
   Route::delete('/{id}',['App\Http\Controllers\SaleController', 'delete'])->name('sale.delete');
   Route::patch('/{id}', ['App\Http\Controllers\SaleController', 'addProduct'])->name('sale.add.product');
});
