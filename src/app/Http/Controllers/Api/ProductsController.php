<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;

class ProductsController extends BaseController
{
    public function __construct()
    {
        $this->serviceClass = ProductService::class;
    }
}
