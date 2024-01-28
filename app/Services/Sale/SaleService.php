<?php

namespace App\Services\Sale;

use App\Enums\Sale\SaleStatus;
use App\Exceptions\Sale\SaleAddProductException;
use App\Http\Filters\Filter;
use App\Models\Product;
use App\Models\Sale\Sale;
use App\Models\Sale\SaleProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleService
{

    public function all(Request $request)
    {
        $sales = Sale::query();

        $filters = (new Filter(Sale::$allowedOperatorsFields));
        $filters->build($sales, $request);

        return $sales->with(['products'])->orderBy('id', 'desc')->paginate(2);
    }

    public function create(array $data): Sale
    {
        $sale = new Sale();

        DB::transaction(function () use ($data, &$sale) {
            $sale = Sale::create(['sale_status_id' => SaleStatus::IN_PROGRESS]);
            $sale->products()->attach($data['products']);

            $sale->amount = $this->sumTotalAmount($sale);
            $sale->save();
        });

        return $sale->load('products');
    }

    public function addProducts(array $data, string $id)
    {
        $sale = $this->findById($id);
        SaleStatusService::checkIfCanAddProductsByStatus($sale);

        $newProducts = [];
        $updateProducts = [];

        DB::transaction(function () use ($data, &$sale, &$newProducts, &$updateProducts) {
            $productAlreadyExists = array_flip($sale->products()->allRelatedIds()->toArray());

            foreach ($data['products'] as $product) {
                if (array_key_exists($product['product_id'], $productAlreadyExists)) {
                    $updateProducts[] = $product;
                } else {
                    $newProducts[] = $product;
                }
            }

            if (!empty($newProducts)) {
                $sale->products()->attach($newProducts);
            }

            if (!empty($updateProducts)) {
                foreach ($updateProducts as $product) {
                    $sale->products()->updateExistingPivot($product['product_id'], $product);
                }
            }

            $sale->amount = $this->sumTotalAmount($sale);
            $sale->save();
        });

        return $sale->load('products');
    }

    public function findById(string $id): Sale
    {
        return Sale::with('products')->findOrFail($id);
    }

    public function delete(string $id): int
    {
        return Sale::destroy($id);
    }

    public function cancel(string $id): Sale
    {
        $sale = $this->findById($id);
        $sale->update(['sale_status_id' => SaleStatus::CANCELED]);

        return $sale;
    }

    private function sumTotalAmount(Sale $sale)
    {
        $sum = 0;
        $sale->products()->each(function($product) use (&$sum) {
            $sum += $product->price * $product->pivot->amount;
        });
        return $sum;
    }
}
