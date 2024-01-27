<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Sale\SaleService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Enums\Messages\Http\Response as MessagesResponse;
use App\Http\Requests\Sale\StorePostSaleRequest;
use App\Http\Resources\Sale\SaleCollection;
use App\Http\Resources\Sale\SaleResource;
use Illuminate\Support\Facades\DB;

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
            MessagesResponse::OK,
            Response::HTTP_OK,
            (new SaleCollection($sales))->response()->getData(true)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostSaleRequest $request)
    {
        $sale = $this->service->create($request->all());
        return $this->success(
            MessagesResponse::CREATED,
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
            MessagesResponse::OK,
            Response::HTTP_OK,
            new SaleResource($sale)
        );
    }

    public function destroy(string $id) {
        $sale = $this->service->delete($id);
        return $this->success(
            MessagesResponse::DELETED,
            Response::HTTP_NO_CONTENT
        );
    }
}
