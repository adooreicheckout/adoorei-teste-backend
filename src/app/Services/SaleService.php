<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\SaleRepository;
use Illuminate\Http\Request;
use App\Models\Sale;

class SaleService
{
    private const LIMIT = 10;

    public static function create(Request $request): object
    {
        $data = $request->all();
        return SaleRepository::create($data);
    }

    public static function getModelById(int $id): object
    {
        return SaleRepository::getModelById($id);
    }

    public static function addProducts(Request $request, Sale $sale): object
    {
        $data = $request->all();
        return SaleRepository::addProducts($data, $sale);
    }

    public static function cancel(Sale $sale): object
    {
        return SaleRepository::update(['is_active' => false], $sale);
    }

    public static function getAll(Request $request): object
    {
        $sale = SaleRepository::findSaleProducts(null, $request->limit);
        return self::formatSaleData($sale, $request);
    }

    public static function getById(int $id): object
    {
        $sale = SaleRepository::findSaleProducts($id);
        if (!is_object($sale) || !isset($sale->id)) {
            return (object) null;
        }

        return self::formatSaleData(collect([$sale]));
    }

    private static function formatSaleData($sale, $request = null): object
    {
        $formattedSale = $sale->map(function ($item) {
            return (object)[
                'sales_id' => $item->id,
                'amount' => $item->saleProduct->sum(function ($product) {
                    return $product->amount * $product->product->price;
                }),
                'products' => $item->saleProduct->map(function ($product) {
                    return (object)[
                        'product_id' => $product->product_id,
                        'nome' => $product->product->name,
                        'price' => $product->product->price,
                        'amount' => $product->amount,
                    ];
                }),
            ];
        });

        if ($request instanceof Request) {
            return new LengthAwarePaginator(
                $formattedSale,
                $sale->total(),
                $request->limit ? $request->limit : self::LIMIT,
                $request->page,
                ['path' => $request->url()]
            );
        }

        return $formattedSale;
    }
}
