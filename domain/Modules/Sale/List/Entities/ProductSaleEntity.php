<?php

namespace Domain\Modules\Sale\List\Entities;

class ProductSaleEntity
{
    public function __construct(
        public readonly int $productId,
        public readonly string $name,
        public readonly float $price,
        public readonly int $quantity
    ) {
    }
}
