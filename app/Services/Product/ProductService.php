<?php

namespace App\Services\Product;

use App\Http\Filters\Filter;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductService
{

    public function all(Request $request)
    {
        $products = Product::query();

        $filters = (new Filter(Product::$allowedOperatorsFields));
        $filters->build($products, $request);

        return $products->orderBy('id', 'desc')->paginate(2);
    }
}
