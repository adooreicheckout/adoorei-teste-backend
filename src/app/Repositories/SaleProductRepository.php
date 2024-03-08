<?php

namespace App\Repositories;

use App\Models\SaleProduct;

class SaleProductRepository
{
    public static function create(array $data): object
    {
        return SaleProduct::create($data);
    }
}
