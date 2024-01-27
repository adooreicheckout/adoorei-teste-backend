<?php

namespace App\Http\Resources\Sale;

use App\Http\Resources\Product\ProductOnSaleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'sale_status_id' => $this->sale_status_id,
            'products' => ProductOnSaleResource::collection($this->products),
        ];
    }
}
