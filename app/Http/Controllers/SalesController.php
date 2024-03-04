<?php

namespace App\Http\Controllers;

use App\Database\Repositories\Eloquent\EloquentProductsRepository;
use App\Database\Repositories\Eloquent\EloquentSalesRepository;
use App\Exceptions\SaleAlreadyCanceledException;
use App\Http\Requests\AddProductsToExistingSaleRequest;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Resources\SaleWithProductsResource;
use App\Http\Resources\SimpleSaleResource;
use App\Models\Sale;
use Domain\UseCases\addProductsToExistingSaleUseCase;
use Domain\UseCases\CancelSaleUseCase;
use Domain\UseCases\CreateSaleUseCase;
use Domain\UseCases\ListSalesUseCase;
use Domain\UseCases\ShowSaleUseCase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class SalesController extends Controller
{
    /**
     * Show all sales with status complete
     */
    public function index(): JsonResponse
    {
        try {
            $salesRepository = new EloquentSalesRepository();
            $listSalesUseCase = new ListSalesUseCase($salesRepository);

            $completeSales = $listSalesUseCase->execute();

            $simpleSalesResource = SimpleSaleResource::collection($completeSales);

            return response()->json($simpleSalesResource);
        } catch (Exception $e) {
            return $this->handleUnexpectedError();
        }
    }

    /**
     * Store a newly created sale in storage.
     */
    public function store(StoreSaleRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $salesRepository = new EloquentSalesRepository();
            $productsRepository = new EloquentProductsRepository();

            $createSaleUseCase = new CreateSaleUseCase(
                $salesRepository, $productsRepository
            );

            $saleCreated = $createSaleUseCase->execute($request->all());
            $saleCreatedResource = new SimpleSaleResource($saleCreated);

            DB::commit();
            return response()->json($saleCreatedResource, Response::HTTP_CREATED);
        } catch (Exception $e) {
            DB::rollBack();

            return $this->handleUnexpectedError();
        }
    }

    /**
     * Display the specified sale with its products.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $salesRepository = new EloquentSalesRepository();
            $showSaleUseCase = new ShowSaleUseCase($salesRepository);

            $saleFound = $showSaleUseCase->execute($id);

            $saleWithProductResource = new SaleWithProductsResource($saleFound);

            return response()->json($saleWithProductResource);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return $this->handleUnexpectedError();
        }
    }

    /**
     * Cancel a sale
     */
    public function cancelSale(string $id): JsonResponse
    {
        try {
            $salesRepository = new EloquentSalesRepository();
            $cancelSaleUseCase = new CancelSaleUseCase($salesRepository);

            $cancelSaleUseCase->execute($id);

            return response()->json([
                'id' => $id,
                'status' => Sale::STATUS_CANCELED,
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

    /**
     * Add Products to an existing sale
     */
    public function addProductsToExistingSale(AddProductsToExistingSaleRequest $request, string $id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $salesRepository = new EloquentSalesRepository();
            $productsRepository = new EloquentProductsRepository();

            $addProductsToExistingSaleUseCase = new AddProductsToExistingSaleUseCase(
                $salesRepository, $productsRepository
            );

            $saleWithProducts = $addProductsToExistingSaleUseCase->execute($request->all(), $id);

            $saleWithProductsResource = new SaleWithProductsResource($saleWithProducts);

            DB::commit();
            return response()->json($saleWithProductsResource, Response::HTTP_CREATED);
        } catch (SaleAlreadyCanceledException $e) {
            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            DB::rollBack();

            dd($e);
            return $this->handleUnexpectedError();
        }
    }
}
