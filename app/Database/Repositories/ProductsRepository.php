<?php

namespace App\Database\Repositories;

use App\Models\Product;
use Illuminate\Http\Request;
use Domain\Repositories\ProductsRepository as ProductsRepositoryInterface;

class ProductsRepository implements ProductsRepositoryInterface
{
    public function findAll()
    {
        $products = Product::get();

        return $products;
    }
}
