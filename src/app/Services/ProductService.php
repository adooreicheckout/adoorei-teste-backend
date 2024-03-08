<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductService
{
    public static function getAll(Request $request): object
    {
        return ProductRepository::getAll($request->is_available, $request->limit);
    }
}
