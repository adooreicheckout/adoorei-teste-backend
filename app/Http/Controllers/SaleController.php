<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleCancelRequest;
use App\Http\Requests\SaleCreateRequest;
use App\Http\Requests\SaleGetRequest;
use App\Services\SaleService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class SaleController extends Controller
{
    public function __construct(
        private SaleService $saleSevice
    ) {
    }

    public function create(SaleCreateRequest $request): JsonResponse
    {
        try {
            $created = $this->saleSevice->create($request);

            return Response()->json($created, Response::HTTP_CREATED);
        } catch (ValidationException $ve) {
            return response()->json([
                'error' => $ve->errors()
            ], Response::HTTP_NOT_ACCEPTABLE);
        } catch (Exception $ve) {
            return response()->json([
                'error' => $ve->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function getById(SaleGetRequest $request): JsonResponse
    {
        try {
            $get = $this->saleSevice->getById($request);

            return Response()->json($get, Response::HTTP_ACCEPTED);
        } catch (ValidationException $ve) {
            return response()->json([
                'error' => $ve->errors()
            ], Response::HTTP_NOT_ACCEPTABLE);
        } catch (Exception $ve) {
            return response()->json([
                'error' => $ve->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function cancel(SaleCancelRequest $request): JsonResponse
    {
        try {
            $cancel = $this->saleSevice->cancel($request);

            return Response()->json($cancel, Response::HTTP_ACCEPTED);
        } catch (ValidationException $ve) {
            return response()->json([
                'error' => $ve->errors()
            ], Response::HTTP_NOT_ACCEPTABLE);
        } catch (Exception $ve) {
            return response()->json([
                'error' => $ve->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function list(): JsonResponse
    {
        try {
            $list = $this->saleSevice->list();

            return Response()->json($list, Response::HTTP_ACCEPTED);
        } catch (Exception $ve) {
            return response()->json([
                'error' => $ve->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
