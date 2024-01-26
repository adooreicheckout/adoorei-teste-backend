<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;
use App\Enums\Messages\Http\Response as MessagesResponse;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $service
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = $this->service->all($request);

        return $this->success(
            MessagesResponse::OK,
            Response::HTTP_OK,
            new ProductResource($products)
        );
    }
}
