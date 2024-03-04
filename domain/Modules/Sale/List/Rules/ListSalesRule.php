<?php

namespace Domain\Modules\Sale\List\Rules;

use Domain\Modules\Sale\Create\Entities\CreatedSale;
use Domain\Modules\Sale\Create\Entities\RequestEntity;
use Domain\Modules\Sale\Create\Gateways\CreateSaleGateway;
use Domain\Modules\Sale\List\Collections\SaleCollection;
use Domain\Modules\Sale\List\Gateways\ListSalesGateway;

class ListSalesRule
{
    public function __construct(private readonly ListSalesGateway $saleGateway)
    {
    }

    public function execute(): SaleCollection
    {
        return $this->saleGateway->list();
    }
}
