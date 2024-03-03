<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Services\SaleService;
use Illuminate\Http\Request;
use App\Http\Requests\Sale\CreateRequest as SaleCreateRequest;

class SaleController extends Controller
{
    private SaleService $saleService;

    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $sales = $this->saleService->list();
            return response()->json($sales);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao listar as vendas! - Exception: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaleCreateRequest $request)
    {
        try {
            $data = $request->validated();
            if ($this->saleService->store($data)) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Venda cadastrada com sucesso!'
                ]);
            }
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao cadastrar a venda!'
            ], 500);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao cadastrar a venda! - Exception: '. $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
