<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSaleProductRequest;
use App\Services\Sales\Contracts\SaleServiceContract;
use Exception;
use Illuminate\Http\{Request, JsonResponse};

class SaleUpdateProductsController extends Controller
{
    /**
     * @var SaleServiceContract $saleService
     */
    protected $saleService;

    /**
     * @param SaleServiceContract $saleService
     */
    public function __construct(SaleServiceContract $saleService)
    {
        $this->saleService = $saleService;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(string $saleId, UpdateSaleProductRequest $request): JsonResponse
    {
        try {
            return response()->json($this->saleService->addProduct($saleId, $request->all()), 200);
        } catch (Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 404);
        }
    }
}
