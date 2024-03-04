<?php

namespace App\Http\Controllers;

use App\Database\Repositories\Eloquent\EloquentProductsRepository;
use App\Database\Repositories\Eloquent\EloquentSalesRepository;
use App\Exceptions\SaleAlreadyCanceledException;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Resources\SaleWithProductsResource;
use App\Http\Resources\SimpleSaleResource;
use App\Models\Sale;
use Domain\UseCases\CancelSaleUseCase;
use Domain\UseCases\CreateSaleUseCase;
use Domain\UseCases\ShowCompletedSalesUseCase;
use Domain\UseCases\ShowSaleUseCase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        try {
            $salesRepository = new EloquentSalesRepository();
            $showSaleUseCase = new ShowSaleUseCase($salesRepository);

            $saleCreated = $showSaleUseCase->execute($id);

            $saleCreatedResource = new SaleWithProductsResource($saleCreated);

            return response()->json($saleCreatedResource);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return $this->handleUnexpectedError();
        }
    }

    public function cancelSale(string $id)
    {
        try {
            $salesRepository = new EloquentSalesRepository();
            $showSaleUseCase = new CancelSaleUseCase($salesRepository);

            $saleCanceled = $showSaleUseCase->execute($id);

            return response()->json([
                'id' => $id,
                'status' => Sale::STATUS_CANCELLED,
            ]);
        } catch (SaleAlreadyCanceledException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return $this->handleUnexpectedError();
        }
    }

    public function showCompletedSales() {
        try {
            $salesRepository = new EloquentSalesRepository();
            $showCompletedSalesUseCase = new ShowCompletedSalesUseCase($salesRepository);

            $sales = $showCompletedSalesUseCase->execute();

            $salesResource = SimpleSaleResource::collection($sales);

            return response()->json($salesResource);
        } catch (Exception $e) {
            return $this->handleUnexpectedError();
        }
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
