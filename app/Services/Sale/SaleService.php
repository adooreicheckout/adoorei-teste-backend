<?php

namespace App\Services\Sale;

use App\Http\Filters\Filter;
use App\Models\Sale\Sale;
use Illuminate\Http\Request;

class SaleService
{

    public function all(Request $request)
    {
        $Sales = Sale::query();

        $filters = (new Filter(Sale::$allowedOperatorsFields));
        $filters->build($Sales, $request);

        return $Sales->orderBy('id', 'desc')->paginate(2);
    }
}
