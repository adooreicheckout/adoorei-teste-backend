<?php

namespace App\Exceptions\Sale;

use App\Traits\HttpResponse;
use Illuminate\Http\Response;
use Exception;

class SaleAddProductException extends Exception
{
    use HttpResponse;

    public function render()
    {
        return $this->error(
            $this->message
        );
    }
}
