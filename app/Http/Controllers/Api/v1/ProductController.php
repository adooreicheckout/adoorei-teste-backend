<?php

namespace App\Http\Controllers\Api\v1;

use App\Adapters\Instrumentation\UseCaseInstrumentationAdapter;
use App\Http\Controllers\Controller;
use App\Http\Responses\ResponseFactory;
use Domain\Generics\Logger\Logger;
use Domain\Modules\Product\List\gateways\ProductGateway;
use Domain\Modules\Product\List\UseCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductGateway $productGateway,
        private readonly Logger $logger
    ) {
    }

    public function list(): JsonResponse
    {
        $listProductUseCase = new UseCase(
            instrumentation: new UseCaseInstrumentationAdapter(useCaseClass: UseCase::class),
            logger: $this->logger,
            productGateway: $this->productGateway
        );
        $useCaseResponse = $listProductUseCase->execute();
        return ResponseFactory::create($useCaseResponse)->present();
    }
}
