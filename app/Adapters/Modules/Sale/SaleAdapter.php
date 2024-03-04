<?php

namespace App\Adapters\Modules\Sale;

use Domain\Modules\Sale\Create\Collections\ProductSaleCollection;
use Domain\Modules\Sale\Create\Entities\CreatedSale;
use Domain\Modules\Sale\Create\Gateways\CreateSaleGateway;
use Domain\Modules\Sale\List\Collections\SaleCollection;
use Domain\Modules\Sale\List\Entities\ProductSaleEntity;
use Domain\Modules\Sale\List\Entities\SaleEntity;
use Domain\Modules\Sale\List\Gateways\ListSalesGateway;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Facades\DB;

class SaleAdapter implements CreateSaleGateway, ListSalesGateway
{
    use HasUuids;

    public function registerNewSale(ProductSaleCollection $productSaleCollection): CreatedSale
    {
        $bulkProductSales = [];

        $saleId = $this->newUniqueId();
        DB::table('sale')->insert(['id' => $saleId]);
        foreach ($productSaleCollection->all() as $productSale) {
            $bulkProductSales[] = [
                "sale_id" => $saleId,
                "product_id" => $productSale->productId,
                "quantity" => $productSale->quantity
            ];
        }
        DB::table('product_sale')->insert($bulkProductSales);
        return new CreatedSale(saleId: $saleId);
    }

    public function list(): SaleCollection
    {

        $sales = DB::table('sale as s')
            ->select('sale_id', DB::raw('SUM(ps.quantity * p.price) as amount'))
            ->selectRaw("JSON_AGG(
                    json_build_object(
                        'product_id', ps.product_id,
                        'name', p.name,
                        'price', p.price,
                        'quantity', ps.quantity
                    )
                ) AS products")
            ->join('product_sale as ps', 'ps.sale_id', '=', 's.id')
            ->join('product as p', 'p.id', '=', 'ps.product_id')
            ->groupBy('sale_id')
            ->get()->map(function ($value) {
                return [
                    'sale_id' => $value->sale_id,
                    'amount' => $value->amount,
                    'products' => json_decode($value->products, true)
                ];
            });
        $saleCollection = new SaleCollection();
        foreach ($sales as $sale) {
            $productSaleCollection = new \Domain\Modules\Sale\List\Collections\ProductSaleCollection();
            foreach ($sale['products'] as $productSale) {
                $productSaleCollection->addProductSale(new ProductSaleEntity(
                    productId: $productSale['product_id'],
                    name: $productSale['name'],
                    price: $productSale['price'],
                    quantity: $productSale['quantity']
                ));
            }
            $saleCollection->addSale(
                new SaleEntity(
                    saleId: $sale['sale_id'],
                    amount: $sale['amount'],
                    products: $productSaleCollection
                )
            );
        }

        return $saleCollection;
    }
}
