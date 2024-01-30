<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Http\Services\SaleService;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    protected $sale;
    protected $saleService;

    public function __construct(Sale $sale,  SaleService $saleService)
    {
        $this->sale = $sale;
        $this->saleService = $saleService;
    }

    public function index()
    {
        try {
            $sales = $this->sale->with('SaleProduct.product')->get();

            if ($sales->isEmpty()) {
                return response()->json(['message' => 'No sales found'], 404);
            }

            $formattedSales = $sales->map(function ($sale) {
                return [
                    'sale_id' => $sale->id,
                    'amount' => $sale->amount,
                    'products' => $sale->SaleProduct->map(function ($saleProduct) {
                        return [
                            'product_id' => $saleProduct->product->id,
                            'name' => $saleProduct->product->name,
                            'price' => $saleProduct->product->price,
                            'quantity' => $saleProduct->quantity,
                        ];
                    }),
                ];
            });

            return response()->json($formattedSales);
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(SaleRequest $request)
    {
        try {

            $json = $request->json();

            $saleData = $json->all();

            $sale =  $this->saleService->createSale($saleData);

            return response()->json($sale);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $sale = $this->sale->with('SaleProduct.product')->find($id);

            if (!$sale) {
                return response()->json(['message' => 'Sale not found'], 404);
            }

            $formattedSale = [
                'sale_id' => $sale->id,
                'amount' => $sale->amount,
                'products' => $sale->SaleProduct->map(function ($saleProduct) {
                    return [
                        'product_id' => $saleProduct->product->id,
                        'name' => $saleProduct->product->name,
                        'price' => $saleProduct->product->price,
                        'quantity' => $saleProduct->quantity,
                    ];
                }),
            ];

            return response()->json($formattedSale);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $json = $request->json();

            $saleData = $json->all();

            $sale =  $this->saleService->updateSale($id, $saleData);

            return response()->json($sale);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $sale = $this->sale->find($id);

            if (!$sale) {
                return response()->json(['message' => 'Sale not found'], 404);
            }

            $sale->SaleProduct()->delete();
            $sale->delete();

            return response()->json(['message' => 'Sale deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
