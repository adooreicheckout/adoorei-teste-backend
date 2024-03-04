<?php

namespace Domain\Modules\Sale\List\Collections;

use Domain\Generics\Collection\Collection;
use Domain\Modules\Sale\Create\Entities\ProductSaleEntity;
use Domain\Modules\Sale\List\Entities\SaleEntity;

class SaleCollection extends Collection
{
    public function addSale(SaleEntity $item): static
    {
        return parent::add($item);
    }

    public function all(): array
    {
        return parent::all();
    }

    public function toArray()
    {
        $salesList = [];
        foreach ($this->data as $sale) {
            $products = [];
            foreach ($sale->products->all() as $product) {
                $products[] = [
                    'product_id' => $product->productId,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $product->quantity
                ];
            }
            $salesList[] = [
                'sale_id' => $sale->saleId,
                'amount' => $sale->amount,
                'products' => $products
            ];
        }
        return $salesList;
    }
}
