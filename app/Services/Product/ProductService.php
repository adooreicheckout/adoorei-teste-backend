<?php

namespace App\Services\Product;

use App\Http\Filters\Filter;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductService
{

    public function all(Request $request)
    {
        $allowedOperatorsFields = [
            'name' => ['eq', 'in', 'lk'],
            'price' => ['gt', 'gte', 'lt', 'lte', 'eq', 'in']
        ];

        $filters = (new Filter($allowedOperatorsFields));
        $products = Product::query();
        $filters->build($products, $request);

        return $products->orderBy('id', 'desc')->paginate(2);
    }
}
