<?php

namespace Domain\Modules\Sale\List\Responses;

use Domain\Generics\Responses\BaseResponse;
use Domain\Modules\Sale\Create\Entities\CreatedSale;
use Domain\Modules\Sale\List\Collections\SaleCollection;

class SuccessResponse extends BaseResponse
{
    public function __construct(public readonly SaleCollection $sales)
    {
    }
}
