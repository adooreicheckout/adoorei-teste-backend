<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Sale\SaleService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Enums\Messages\Http\Response as MessagesResponse;
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
            MessagesResponse::OK,
            Response::HTTP_OK,
            new SaleResource($sales)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
