<?php

namespace App\Http\Responses;

use App\Models\Sale;
use Illuminate\Http\JsonResponse;

class SaleResponse extends JsonResponse
{
    public function __construct($saleId)
    {
        $sale = Sale::findOrFail($saleId);

        $formattedData = [
            'sales_id' => $sale->id,
            'amount' => $sale->amount,
            'products' => $sale->saleproduct->map(function ($product) {
                return [
                    'product_id' => $product->id,
                    'nome' => $product->name,
                    'price' => $product->price,
                    'quantity' => $product->quantity,
                    ];
            }),
        ];

        parent::__construct($formattedData);
    }

}
