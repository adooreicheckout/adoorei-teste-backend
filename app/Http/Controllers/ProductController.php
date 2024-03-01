<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService
    ) {
    }

    public function list(): JsonResponse
    {
        try {
            $list = $this->productService->list();

            return Response()->json($list, Response::HTTP_ACCEPTED);
        } catch (Exception $ve) {
            return response()->json([
                'error' => $ve->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
