<?php

namespace Domain\Modules\Sale\List\Collections;

use Domain\Generics\Collection\Collection;
use Domain\Modules\Sale\List\Entities\ProductSaleEntity;

class ProductSaleCollection extends Collection
{
    public function addProductSale(ProductSaleEntity $item): static
    {
        return parent::add($item);
    }

    public function all(): array
    {
        return parent::all();
    }
}
