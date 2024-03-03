<?php

namespace App\Database\Repositories\Eloquent;

use App\Models\Product;
use Illuminate\Http\Request;
use Domain\Repositories\ProductsRepository as ProductsRepositoryInterface;

class EloquentProductsRepository implements ProductsRepositoryInterface
{
    public function findAll()
    {
        $products = Product::get();

        return $products;
    }
}
