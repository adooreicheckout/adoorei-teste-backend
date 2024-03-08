<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Services\RequestService;
use App\Services\ErrorService;
use Illuminate\Http\Request;
use Throwable;

/**
 * @OA\Info(
 *     version="1.0",
 *     title="API - ABC STORE"
 * ),
 */
abstract class BaseController
{
    protected $serviceClass;
    protected $requestClass;

    public function store(Request $request)
    {
        try {
            $validation = RequestService::makeValidation($this->requestClass, $request);
            if (count($validation) > 0) {
                return response()->json(
                    $validation,
                    Response::HTTP_BAD_REQUEST
                );
            }

            DB::beginTransaction();
            $create = $this->serviceClass::create($request);
            DB::commit();

            return response()->json(
                $create,
                isset($create->error) ? Response::HTTP_BAD_REQUEST : Response::HTTP_CREATED
            );
        } catch (Throwable $exception) {
            DB::rollBack();
            return ErrorService::expectationFailed($exception);
        }
    }

    public function index(Request $request)
    {
        try {
            $data = $this->serviceClass::getAll($request);
            if (get_class($data) == 'stdClass' ? !isset($data->data) : !isset($data[0])) {
                return response()->json(
                    [],
                    Response::HTTP_NO_CONTENT
                );
            }

            return response()->json(
                $data,
                Response::HTTP_OK
            );
        } catch (Throwable $exception) {
            return ErrorService::expectationFailed($exception);
        }
    }

    public function show(int $id)
    {
        try {
            $response = $this->serviceClass::getById($id);
            if (empty((array) $response)) {
                return response()->json(
                    [
                        'error' => 'Content not found.'
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }

            return response()->json(
                $response,
                Response::HTTP_OK
            );
        } catch (Throwable $exception) {
            return ErrorService::expectationFailed($exception);
        }
    }

    public function addProducts(Request $request)
    {
        try {
            $validation = RequestService::makeValidation($this->requestClass, $request);
            if (count($validation) > 0) {
                return response()->json(
                    $validation,
                    Response::HTTP_BAD_REQUEST
                );
            }

            $model = $this->serviceClass::getModelById($request->id);
            if (empty($model->id)) {
                return response()->json(
                    [
                        'error' => 'Content not Found.'
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }

            DB::beginTransaction();
            $response = $this->serviceClass::addProducts($request, $model);
            DB::commit();

            return response()->json(
                $response,
                isset($response->error) ? Response::HTTP_BAD_REQUEST : Response::HTTP_OK
            );
        } catch (Throwable $exception) {
            DB::rollBack();
            return ErrorService::expectationFailed($exception);
        }
    }

    public function cancel(Request $request)
    {
        try {
            $model = $this->serviceClass::getModelById($request->id);
            if (empty($model->id)) {
                return response()->json(
                    [
                        'error' => 'Content not Found.'
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }

            DB::beginTransaction();
            $response = $this->serviceClass::cancel($model);
            DB::commit();

            return response()->json(
                $response,
                isset($response->error) ? Response::HTTP_BAD_REQUEST : Response::HTTP_OK
            );
        } catch (Throwable $exception) {
            DB::rollBack();
            return ErrorService::expectationFailed($exception);
        }
    }
}
