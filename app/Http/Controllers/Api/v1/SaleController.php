<?php

namespace App\Http\Controllers\Api\v1;

use App\Adapters\Instrumentation\UseCaseInstrumentationAdapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Modules\Sale\CreateSaleRequest;
use App\Http\Responses\ResponseFactory;
use Domain\Generics\Logger\Logger;
use Domain\Modules\Sale\Create\Gateways\CreateSaleGateway;
use Domain\Modules\Sale\Create\UseCase;
use Domain\Modules\Sale\List\Gateways\ListSalesGateway;
use Symfony\Component\HttpFoundation\JsonResponse;

class SaleController extends Controller
{
    public function __construct(
        private readonly CreateSaleGateway $createSaleGateway,
        private readonly ListSalesGateway $listSalesGateway,
        private readonly Logger $logger
    ) {
    }

    public function createSale(CreateSaleRequest $request): JsonResponse
    {
        $createSaleUseCase = new UseCase(
            saleGateway: $this->createSaleGateway,
            logger: $this->logger,
            instrumentation: new UseCaseInstrumentationAdapter(UseCase::class)
        );
        $useCaseResponse = $createSaleUseCase->execute($request->toUseCaseRequest());
        return ResponseFactory::create($useCaseResponse)->present();
    }

    public function list(): JsonResponse
    {
        $listSalesUseCase = new \Domain\Modules\Sale\List\UseCase(
            saleGateway: $this->listSalesGateway,
            logger: $this->logger,
            instrumentation: new UseCaseInstrumentationAdapter(UseCase::class)
        );

        $useCaseResponse = $listSalesUseCase->execute();

        return ResponseFactory::create($useCaseResponse)->present();
    }
}
