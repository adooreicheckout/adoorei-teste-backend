<?php

namespace App\Database\Repositories\Eloquent;

use App\Models\ProductSale;
use App\Models\Sale;
use Illuminate\Http\Request;
use Domain\Repositories\SalesRepository;

class EloquentSalesRepository implements SalesRepository
{
    public function create($saleData)
    {
        $saleCreated = Sale::create([
            'amount' => $saleData['amount'],
            'status' => $saleData['status'],
        ]);

        return $saleCreated;
    }

    public function createProductsBySale($productData, $saleId)
    {
        $productBySaleCreated = ProductSale::create([
            'amount' => $productData['amount'],
            'price' => $productData['price'],
            'product_id' => $productData['product_id'],
            'sale_id' => $saleId,
        ]);

        return $productBySaleCreated;
    }

    public function update($data, $sale)
    {
        $sale->update($data);

        $sale->refresh();

        return $sale;
    }

    public function updateSaleStatusById($status, $sale)
    {
        $saleUpdated = Sale::where('id', $saleId)
            ->update(['status' => $status]);

        return $saleUpdated;
    }
}
