<?php

namespace Domain\Modules\Product\List;

use Domain\Generics\Instrumentation\UseCaseInstrumentation;
use Domain\Generics\Logger\Logger;
use Domain\Generics\Responses\BaseResponse;
use Domain\Generics\Responses\ErrorResponse;
use Domain\Modules\Product\List\gateways\ProductGateway;
use Domain\Modules\Product\List\Responses\SuccessResponse;
use Domain\Modules\Product\List\Rules\ListProductsRule;

class UseCase
{
    private ListProductsRule $rule;

    public function __construct(
        private readonly UseCaseInstrumentation $instrumentation,
        private readonly Logger $logger,
        ProductGateway $productGateway
    ) {
        $this->rule = new ListProductsRule($productGateway);
    }

    public function execute(): BaseResponse
    {
        try {
            $this->instrumentation->useCaseStarted();
            $productsCollection = $this->rule->execute();
            $this->instrumentation->useCaseFinished();
            return new SuccessResponse($productsCollection);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage(), context: [$exception]);
            $this->instrumentation->useCaseFailed($exception);
            return new ErrorResponse($exception);
        }
    }
}
