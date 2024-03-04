<?php

namespace App\Http\Controllers;

use App\Services\Sales\Contracts\SaleServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;

class SalesListController extends Controller
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
    public function __invoke(): JsonResponse
    {
        try {
            return response()->json($this->saleService->get(), 200);
        } catch (Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 404);
        }
    }
}
