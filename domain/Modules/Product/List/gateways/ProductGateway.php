<?php

namespace Domain\Modules\Product\List\gateways;

use Domain\Modules\Product\List\Collection\ProductCollection;

interface ProductGateway
{
    public function list(): ProductCollection;
}
