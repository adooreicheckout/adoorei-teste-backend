<?php

namespace App\Database\Repositories\Eloquent;

use App\Models\ProductSale;
use App\Models\Sale;
use Domain\Repositories\SalesRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class EloquentSalesRepository implements SalesRepository
{
    public function create(array $saleData): Sale
    {
        $saleCreated = Sale::create([
            'amount' => $saleData['amount'],
            'status' => $saleData['status'],
        ]);

        return $saleCreated;
    }

    public function createProductsBySale(array $productData, int $saleId): ProductSale
    {
        $productBySaleCreated = ProductSale::create([
            'amount' => $productData['amount'],
            'price' => $productData['price'],
            'product_id' => $productData['product_id'],
            'sale_id' => $saleId,
        ]);

        return $productBySaleCreated;
    }

    public function update(array $data, Sale $sale): Sale
    {
        $sale->update($data);

        $sale->refresh();

        return $sale;
    }

    public function findById(int $id): Sale
    {
        $sale = Sale::findOrFail($id);

        return $sale;
    }

    public function findByIdWithProducts(int $saleId): Sale
    {
        $sale = Sale::with('products.product')->findOrFail($saleId);

        return $sale;
    }

    public function findByStatus(string $status): Collection
    {
        $sales = Sale::where('status', $status)->get();

        return $sales;
    }
}
