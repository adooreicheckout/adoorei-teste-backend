<?php

namespace App\Http\Controllers;

use App\Database\Repositories\Eloquent\EloquentProductsRepository;
use App\Database\Repositories\Eloquent\EloquentSalesRepository;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Resources\SimpleSaleResource;
use Domain\UseCases\CreateSaleUseCase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        try {
            DB::beginTransaction();

            $salesRepository = new EloquentSalesRepository();
            $productsRepository = new EloquentProductsRepository();

            $createSale = new CreateSaleUseCase(
                $salesRepository, $productsRepository
            );

            $saleCreated = $createSale->execute($request->all());

            $saleCreatedResource = new SimpleSaleResource($saleCreated);
            
            DB::commit();
            return response()->json($saleCreatedResource, Response::HTTP_CREATED);
        } catch (Exception $e) {
            DB::rollBack();

            return $this->handleUnexpectedError();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
