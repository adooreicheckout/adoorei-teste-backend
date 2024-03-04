<?php

namespace App\Http\Controllers;

use App\Services\Sales\Contracts\SaleServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;

class SaleConsultController extends Controller
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
            return response()->json($this->saleService->getById($saleId), 200);
        } catch (Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 404);
        }
    }
}
