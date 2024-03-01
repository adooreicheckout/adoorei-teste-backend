<?php
namespace App\Traits;

use App\Models\SaleProduct;

trait SaleProductsInsert {

    public function saleProductsInsert($saleId, $sale): void
    {
        foreach ($sale['saleProducts'] as $product)
        {
            SaleProduct::create([
                'sale_id' => $saleId,
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $sale['quantity'][$product->id]
            ]);
        }
    }
}
