<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public static function getAll(bool $isAvailable = null, int $limit = null): object
    {
        return Product::orderBy('id')
            ->when(isset($isAvailable), function ($query) use ($isAvailable) {
                return $query->where('is_available', $isAvailable);
            })
            ->select('name', 'price', 'description')
            ->paginate($limit);
    }
}
