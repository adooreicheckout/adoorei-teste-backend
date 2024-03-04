<?php

namespace App\Http\Presenters\Modules\Product\List;

use App\Http\Presenters\BasePresenter;
use Domain\Modules\Product\List\Responses\SuccessResponse;
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
            data: $this->successResponse->productCollection->toArray(),
            status: Response::HTTP_OK
        );
    }
}
