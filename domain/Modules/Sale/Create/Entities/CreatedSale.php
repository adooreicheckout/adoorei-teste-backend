<?php

namespace Domain\Modules\Sale\Create\Entities;

class CreatedSale
{
    public function __construct(public readonly string $saleId)
    {
    }
}
