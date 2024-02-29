<?php

namespace App\Domain\Product\Repositories;

use App\Domain\Product\Entities\Product;
use Illuminate\Database\Eloquent\Collection;

class EloquentProductRepository implements ProductRepository
{
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data): bool
    {
        return $product->update($data);
    }

    public function delete(Product $product): bool
    {
        return $product->delete();
    }

    public function getAll(): Collection
    {
        return Product::all();
    }
}
