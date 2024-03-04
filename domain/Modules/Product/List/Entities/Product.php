<?php

namespace Domain\Modules\Product\List\Entities;

class Product
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly float $price,
        public readonly string $description
    ) {
    }
}
