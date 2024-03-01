<?php

namespace App\Http\Responses;

use App\Models\Sale;
use Illuminate\Http\JsonResponse;

class AllSalesResponse extends JsonResponse
{
    public function __construct()
    {
        $sales = Sale::all();

        $formattedData = [
            'sales' => $sales->map(function ($sale){
                return [
                    'sale_id' => $sale->id,
                    'amount' => $sale->amount
                ];
            }),
        ];
        parent::__construct($formattedData);
    }
}
