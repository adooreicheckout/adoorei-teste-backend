<?php

namespace App\Http\Responses;

use App\Http\Presenters\BasePresenter;
use App\Http\Presenters\Generics\ErrorPresenter;
use App\Http\Presenters\Modules\Product\List\SuccessPresenter;
use Domain\Generics\Responses\BaseResponse;
use Domain\Modules\Product\List\Responses\SuccessResponse;

class ResponseFactory
{
    public static function create(BaseResponse $useCaseResponse): BasePresenter
    {
        if ($useCaseResponse instanceof SuccessResponse) {
            return new SuccessPresenter($useCaseResponse);
        }
        if ($useCaseResponse instanceof \Domain\Modules\Sale\Create\Responses\SuccessResponse) {
            return new \App\Http\Presenters\Modules\Sale\Create\SuccessPresenter($useCaseResponse);
        }
        if ($useCaseResponse instanceof \Domain\Modules\Sale\List\Responses\SuccessResponse) {
            return new \App\Http\Presenters\Modules\Sale\List\SuccessPresenter($useCaseResponse);
        }
        return new ErrorPresenter();
    }
}
