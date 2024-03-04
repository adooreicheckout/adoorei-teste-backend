<?php

namespace App\Http\Controllers;

use App\Services\Products\Contracts\ProductServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;

class ProductsListController extends Controller
{
    /**
     * @var ProductServiceContract $productService
     */
    protected $productService;

    /**
     * @param ProductServiceContract $productService
     */
    public function __construct(ProductServiceContract $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        try {
            return response()->json($this->productService->get(), 200);
        } catch (Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 404);
        }
    }
}
