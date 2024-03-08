<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SaleRequest;
use App\Services\SaleService;

class SalesController extends BaseController
{
    public function __construct()
    {
        $this->serviceClass = SaleService::class;
        $this->requestClass = SaleRequest::class;
    }
}
