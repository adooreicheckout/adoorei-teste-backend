<?php

namespace Domain\Modules\Sale\Create\Entities;

use Domain\Modules\Sale\Create\Collections\ProductSaleCollection;

class RequestEntity
{
    public function __construct(
        public readonly ProductSaleCollection $productSaleCollection
    ) {
    }
}
