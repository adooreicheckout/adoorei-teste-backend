<?php

namespace Domain\Modules\Sale\List;

use Domain\Generics\Instrumentation\UseCaseInstrumentation;
use Domain\Generics\Logger\Logger;
use Domain\Generics\Responses\BaseResponse;
use Domain\Generics\Responses\ErrorResponse;
use Domain\Modules\Sale\List\Gateways\ListSalesGateway;
use Domain\Modules\Sale\List\Responses\SuccessResponse;
use Domain\Modules\Sale\List\Rules\ListSalesRule;

class UseCase
{
    private ListSalesRule $rule;


    public function __construct(
        private ListSalesGateway $saleGateway,
        private readonly Logger $logger,
        private readonly UseCaseInstrumentation $instrumentation
    ) {
        $this->rule = new ListSalesRule($this->saleGateway);
    }

    public function execute(): BaseResponse
    {
        try {
            $this->instrumentation->useCaseStarted();
            $sales = $this->rule->execute();
            $this->instrumentation->useCaseFinished();
            return new SuccessResponse(sales: $sales);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage(), context: [$exception]);
            $this->instrumentation->useCaseFailed($exception);
            return new ErrorResponse($exception);
        }
    }
}
