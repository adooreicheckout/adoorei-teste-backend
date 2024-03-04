<?php

namespace Domain\Modules\Sale\Create\Gateways;

use Domain\Modules\Sale\Create\Collections\ProductSaleCollection;
use Domain\Modules\Sale\Create\Entities\CreatedSale;

interface CreateSaleGateway
{
    public function registerNewSale(ProductSaleCollection $productSaleCollection): CreatedSale;
}
