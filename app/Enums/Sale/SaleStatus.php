<?php

namespace App\Enums\Sale;

enum SaleStatus: int
{
    case IN_PROGRESS = 1;
    case COMPLETE = 2;
    case CANCELED = 3;
}
