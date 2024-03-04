<?php

namespace App\Http\Presenters\Modules\Sale\List;

use App\Http\Presenters\BasePresenter;
use Domain\Modules\Sale\List\Responses\SuccessResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class SuccessPresenter implements BasePresenter
{
    public function __construct(private readonly SuccessResponse $successResponse)
    {
    }

    public function present(): JsonResponse
    {
        return new JsonResponse(
            data: $this->successResponse->sales->toArray(),
            status: Response::HTTP_OK
        );
    }
}
