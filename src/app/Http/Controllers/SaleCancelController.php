<?php

namespace App\Http\Controllers;

use App\Services\Sales\Contracts\SaleServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;

class SaleCancelController extends Controller
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
    public function __invoke(string $saleId): JsonResponse
    {
        try {
            $cancelSale = $this->saleService->cancelSale($saleId);

            if (! $cancelSale) {
                return response()->json(false, 200);
            }

            return response()->json(true, 200);
        } catch (Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 404);
        }
    }
}
