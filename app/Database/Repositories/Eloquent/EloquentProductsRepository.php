<?php

namespace App\Database\Repositories\Eloquent;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Domain\Repositories\ProductsRepository as ProductsRepositoryInterface;

class EloquentProductsRepository implements ProductsRepositoryInterface
{
    public function findAll(): Collection
    {
        $products = Product::get();

        return $products;
    }

    public function findById(int $id): Product
    {
        $product = Product::findOrFail($id);

        return $product;
    }
}
