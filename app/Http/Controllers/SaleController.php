<?php

namespace App\Http\Controllers;

use App\Actions\SaleAddProduct;
use App\Actions\SaleCreateAction;
use App\Http\Responses\AllSalesResponse;
use App\Http\Responses\SaleResponse;
use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public function index(): AllSalesResponse
    {
        return new AllSalesResponse();
    }

    public function addProduct($id, Request $request): \Illuminate\Http\JsonResponse
    {
        return app(SaleAddProduct::class)->execute($id, $request);
    }

    public function delete($id): \Illuminate\Http\JsonResponse
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();

        return response()->json(['message' => 'Sale deleted successfully'], 200);
    }

    public function show($saleId): SaleResponse
    {
        return new SaleResponse($saleId);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        return app(SaleCreateAction::class)->execute($request);
    }

}
