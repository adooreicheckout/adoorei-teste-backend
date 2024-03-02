<?php

namespace App\Enum;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self pending()
 * @method static self completed()
 * @method static self cancelled()
 */
class SaleStatus extends Enum
{
    protected static function values(): array
    {
        return [
            'pending' => 'pending',
            'completed' => 'completed',
            'cancelled' => 'cancelled',
        ];
    }
}
