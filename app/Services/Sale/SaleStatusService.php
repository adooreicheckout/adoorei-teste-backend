<?php

namespace App\Services\Sale;

use App\Enums\Sale\SaleStatus;
use App\Exceptions\Sale\SaleAddProductException;
use App\Models\Sale\Sale;

class SaleStatusService
{
    public static function checkIfCanAddProductsByStatus(Sale $sale)
    {
        if ($sale->sale_status_id === SaleStatus::CANCELED) {
            throw new SaleAddProductException("It is not possible to add products and a sale is canceled");
        }
    }
}
