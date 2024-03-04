<?php

namespace Domain\Modules\Sale\List\Entities;

use Domain\Modules\Sale\List\Collections\ProductSaleCollection;

class SaleEntity
{
    public function __construct(
        public readonly string $saleId,
        public readonly float $amount,
        public readonly ProductSaleCollection $products
    ) {
    }
}
