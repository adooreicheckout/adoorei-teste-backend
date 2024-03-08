<?php

namespace App\Repositories;

use App\Models\SaleProduct;
use App\Models\Sale;

class SaleRepository
{
    public static function create(array $data): object
    {
        $sale = Sale::create($data);

        foreach ($data['products'] as $item) {
            $product = new SaleProduct([
                'product_id' => $item['product_id'],
                'amount' => $item['amount'],
            ]);

            $sale->saleProduct()->save($product);
        }

        return $sale->fresh();
    }

    public static function getModelById(int $id): object
    {
        $sale = Sale::find($id);
        return isset($sale) ? $sale : (object) null;
    }

    public static function findSaleProducts(int $id = null, int $limit = null): object
    {
        $query = Sale::with('saleProduct.product');

        if ($id !== null) {
            $response = $query->where('id', $id)
                ->first();
        } else {
            $response = $query->where('is_active', true)
                ->paginate($limit);
        }

        return $response ? $response : (object) null;
    }

    public static function addProducts(array $data, Sale $sale): object
    {
        foreach ($data['products'] as $item) {
            $product = new SaleProduct([
                'product_id' => $item['product_id'],
                'amount' => $item['amount'],
            ]);

            $sale->saleProduct()->save($product);
        }

        return $sale->fresh();
    }

    public static function update(array $data, Sale $sale): object
    {
        $sale->fill($data)->save();
        return $sale->fresh();
    }
}
