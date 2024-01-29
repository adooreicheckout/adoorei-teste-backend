<?php

namespace App\Http\Controllers\Api\Sale;

use App\Http\Controllers\Controller;
use App\Services\Sale\SaleService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Enums\Messages\Sale\SaleMessage;
use App\Http\Requests\Sale\SaleRequest;
use App\Http\Resources\Sale\SaleCollection;
use App\Http\Resources\Sale\SaleResource;

class SaleController extends Controller
{
    public function __construct(
        private SaleService $service
    ) {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sales = $this->service->all($request);

        return $this->success(
            SaleMessage::OK,
            Response::HTTP_OK,
            (new SaleCollection($sales))->response()->getData(true)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaleRequest $request)
    {
        $sale = $this->service->create($request->all());
        return $this->success(
            SaleMessage::CREATED,
            Response::HTTP_CREATED,
            new SaleResource($sale)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sale = $this->service->findById($id);
        return $this->success(
            SaleMessage::OK,
            Response::HTTP_OK,
            new SaleResource($sale)
        );
    }

    public function destroy(string $id) {
        $this->service->delete($id);
        return $this->success(
            SaleMessage::DELETED,
            Response::HTTP_OK
        );
    }

    public function cancel(string $id)
    {
        $this->service->cancel($id);

        return $this->success(
            SaleMessage::CANCELED,
            Response::HTTP_OK,
        );
    }

    public function addProducts(SaleRequest $request, string $id)
    {
        $sale = $this->service->addProducts($request->all(), $id);

        return $this->success(
            SaleMessage::ADD_PRODUCTS,
            Response::HTTP_OK,
            new SaleResource($sale)
        );
    }
}
