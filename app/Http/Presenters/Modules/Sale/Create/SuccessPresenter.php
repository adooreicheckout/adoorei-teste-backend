<?php

namespace App\Http\Presenters\Modules\Sale\Create;

use App\Http\Presenters\BasePresenter;
use Domain\Modules\Sale\Create\Responses\SuccessResponse;
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
            data: [
                'sale_id' => $this->successResponse->createdSale->saleId
            ],
            status: Response::HTTP_CREATED
        );
    }
}
