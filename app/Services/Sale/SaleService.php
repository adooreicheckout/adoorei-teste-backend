<?php

namespace App\Services\Sale;

use App\Enums\Sale\SaleStatus;
use App\Http\Filters\Filter;
use App\Models\Product;
use App\Models\Sale\Sale;
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
        $amounts = [];
        $sum = 0;
        /**
         * array $products = ['product_id' => 1, 'amount' => 2 ]
        */
        foreach ($data['products'] as $products) {
            $amounts[$products['product_id']] = $products['amount'];
        }

        DB::transaction(function () use ($data, &$sale, $amounts, &$sum) {
            $sale = Sale::create(['sale_status_id' => SaleStatus::IN_PROGRESS]);
            $sale->products()->attach($data['products']);

            $sale->products()->each(function($product) use (&$sum, $amounts) {
                $sum += $product->price * $amounts[$product->id];
            });

            $sale->amount = $sum;
            $sale->save();
        });

        return $sale->load('products');
    }
}
