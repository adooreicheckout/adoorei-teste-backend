<?php

namespace Domain\Modules\Sale\Create\Collections;

use Domain\Generics\Collection\Collection;
use Domain\Modules\Sale\Create\Entities\ProductSaleEntity;

class ProductSaleCollection extends Collection
{
    public function addProductSale(ProductSaleEntity $productSaleEntity): static
    {
        return parent::add($productSaleEntity);
    }

    public function all(): array
    {
        return parent::all();
    }
}
