<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSaleRequest;
use App\Services\Sales\Contracts\SaleServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;

class SalesStoreController extends Controller
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
     * @param CreateSaleRequest $request
     * @return JsonResponse
     */
    public function __invoke(CreateSaleRequest $request)
    {
        try {
            $store = $this->saleService->create($request->all());

            return response()->json($store, 200);
        } catch (Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 404);
        }
    }
}
