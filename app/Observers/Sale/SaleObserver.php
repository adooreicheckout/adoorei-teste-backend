<?php

namespace App\Observers\Sale;

use App\Models\Sale\Sale;

class SaleObserver
{
    /**
     * Handle the Sale "deleting" event.
     */
    public function deleting(Sale $sale): void
    {
        $sale->products()->detach();
    }
}
