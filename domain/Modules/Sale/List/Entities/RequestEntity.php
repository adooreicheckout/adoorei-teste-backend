<?php

namespace Domain\Modules\Sale\List\Entities;

use Domain\Modules\Sale\List\Collections\ProductSaleCollection;

class RequestEntity
{
    public function __construct(
        public readonly ProductSaleCollection $salesCollection
    ) {
    }
}
