<?php

namespace Domain\Modules\Sale\List\Gateways;

use Domain\Modules\Sale\Create\Collections\ProductSaleCollection;
use Domain\Modules\Sale\Create\Entities\CreatedSale;
use Domain\Modules\Sale\List\Collections\SaleCollection;

interface ListSalesGateway
{
    public function list(): SaleCollection;
}
