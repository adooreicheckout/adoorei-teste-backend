<?php

namespace Domain\Modules\Sale\Create;

use Domain\Generics\Instrumentation\UseCaseInstrumentation;
use Domain\Generics\Logger\Logger;
use Domain\Generics\Responses\BaseResponse;
use Domain\Generics\Responses\ErrorResponse;
use Domain\Modules\Sale\Create\Entities\RequestEntity;
use Domain\Modules\Sale\Create\Gateways\CreateSaleGateway;
use Domain\Modules\Sale\Create\Responses\SuccessResponse;
use Domain\Modules\Sale\Create\Rules\RegisterSaleRule;

class UseCase
{
    private RegisterSaleRule $rule;


    public function __construct(
        private CreateSaleGateway $saleGateway,
        private readonly Logger $logger,
        private readonly UseCaseInstrumentation $instrumentation
    ) {
        $this->rule = new RegisterSaleRule($this->saleGateway);
    }

    public function execute(RequestEntity $requestEntity): BaseResponse
    {
        try {
            $this->instrumentation->useCaseStarted();
            $createdSale = $this->rule->execute($requestEntity);
            $this->instrumentation->useCaseFinished();
            return new SuccessResponse($createdSale);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage(), context: [$exception]);
            $this->instrumentation->useCaseFailed($exception);
            return new ErrorResponse($exception);
        }
    }
}
