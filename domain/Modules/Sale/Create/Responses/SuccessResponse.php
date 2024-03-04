<?php

namespace Domain\Modules\Sale\Create\Responses;

use Domain\Generics\Responses\BaseResponse;
use Domain\Modules\Sale\Create\Entities\CreatedSale;

class SuccessResponse extends BaseResponse
{
    public function __construct(public readonly CreatedSale $createdSale)
    {
    }
}
