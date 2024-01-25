<?php

namespace App\Enums\Sale;

enum SaleStatus: int
{
    case COMPLETE = 1;
    case IN_PROGRESS = 2;
    case CANCELED = 3;
}
