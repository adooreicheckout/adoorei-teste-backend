<?php

namespace Domain\Modules\Product\List\Rules;

use Domain\Modules\Product\List\Collection\ProductCollection;
use Domain\Modules\Product\List\gateways\ProductGateway;

class ListProductsRule
{
    public function __construct(private readonly ProductGateway $productGateway)
    {
    }

    public function execute(): ProductCollection
    {
        return $this->productGateway->list();
    }
}
