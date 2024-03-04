<?php

namespace Domain\Modules\Sale\Create\Rules;

use Domain\Modules\Sale\Create\Entities\CreatedSale;
use Domain\Modules\Sale\Create\Entities\RequestEntity;
use Domain\Modules\Sale\Create\Gateways\CreateSaleGateway;

class RegisterSaleRule
{
    public function __construct(private readonly CreateSaleGateway $saleGateway)
    {
    }

    public function execute(RequestEntity $requestEntity): CreatedSale
    {
        return $this->saleGateway->registerNewSale($requestEntity->productSaleCollection);
    }
}
