<?php

namespace Domain\Modules\Sale\Create\Entities;

class ProductSaleEntity
{
    public function __construct(public readonly int $productId, public string $quantity)
    {
    }
}
