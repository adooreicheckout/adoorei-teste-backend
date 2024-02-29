<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository extends AbstractEloquentRepository implements ProductRepositoryInterface
{
    protected function getModelClassName(): string
    {
        return Product::class;
    }
}
