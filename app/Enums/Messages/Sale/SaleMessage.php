<?php

namespace App\Enums\Messages\Sale;

use App\Enums\Messages\Message;

abstract class SaleMessage extends Message
{
    const CANCELED = 'Success in canceling sale';
}
