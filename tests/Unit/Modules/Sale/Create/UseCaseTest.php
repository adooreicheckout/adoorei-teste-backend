<?php

namespace Tests\Unit\Modules\Sale\Create;

use Domain\Generics\Instrumentation\UseCaseInstrumentation;
use Domain\Generics\Logger\Logger;
use Domain\Generics\Responses\ErrorResponse;
use Domain\Modules\Sale\Create\Collections\ProductSaleCollection;
use Domain\Modules\Sale\Create\Entities\CreatedSale;
use Domain\Modules\Sale\Create\Entities\ProductSaleEntity;
use Domain\Modules\Sale\Create\Entities\RequestEntity;
use Domain\Modules\Sale\Create\Gateways\CreateSaleGateway;
use Domain\Modules\Sale\Create\Responses\SuccessResponse;
use Domain\Modules\Sale\Create\UseCase;
use Mockery;
use PHPUnit\Framework\TestCase;

class UseCaseTest extends TestCase
{
    private UseCaseInstrumentation $instrumentationMock;
    private CreateSaleGateway $createSaleMock;
    private Logger $loggerMock;
    private UseCase $useCase;

    public function setUp(): void
    {
        $this->instrumentationMock = Mockery::mock(UseCaseInstrumentation::class);
        $this->createSaleMock = Mockery::mock(CreateSaleGateway::class);
        $this->loggerMock = Mockery::mock(Logger::class);
        $this->useCase = new UseCase(
            saleGateway: $this->createSaleMock,
            logger: $this->loggerMock,
            instrumentation: $this->instrumentationMock
        );
    }

    /**
     * @dataProvider useCaseSuccessDataProvider
     */
    public function testShouldExecuteUseCaseWithSuccess(
        RequestEntity   $expectedRequestEntity,
        SuccessResponse $expectedUseCaseResponse
    ) {
        $this->instrumentationMock->shouldReceive('useCaseStarted')->withNoArgs()->once();
        $this->instrumentationMock->shouldReceive('useCaseFinished')->withNoArgs()->once();
        $this->createSaleMock->shouldReceive('registerNewSale')->with($expectedRequestEntity->productSaleCollection)->andReturn($expectedUseCaseResponse->createdSale);
        $useCaseResponse = $this->useCase->execute($expectedRequestEntity);
        $this->assertEquals($expectedUseCaseResponse, $useCaseResponse);
    }

    /**
     * @dataProvider useCaseExceptionDataProvider
     */
    public function testShouldExecuteUseCaseWithException(
        RequestEntity $expectedRequestEntity,
        \Throwable    $expectedException,
        ErrorResponse $expectedUseCaseResponse
    ) {
        $this->instrumentationMock->shouldReceive('useCaseStarted')->withNoArgs()->once();
        $this->instrumentationMock->shouldReceive('useCaseFailed')->with($expectedException)->once();
        $this->createSaleMock->shouldReceive('registerNewSale')->with($expectedRequestEntity->productSaleCollection)->andThrow($expectedException);
        $this->loggerMock->shouldReceive('error')->withArgs(["", [$expectedException]])->once();
        $useCaseResponse = $this->useCase->execute($expectedRequestEntity);
        $this->assertEquals($expectedUseCaseResponse, $useCaseResponse);
    }

    public static function useCaseSuccessDataProvider(): array
    {
        $productSaleCollection = self::generateSaleCollectionNotEmpty();
        return [
            [
                new RequestEntity(productSaleCollection: $productSaleCollection),
                new SuccessResponse(createdSale: new CreatedSale(fake()->uuid))
            ],

        ];
    }

    public static function useCaseExceptionDataProvider()
    {

        return [
            [
                new RequestEntity(productSaleCollection: new ProductSaleCollection()),
                new \DomainException(),
                new ErrorResponse(exception: new \DomainException())

            ],
            [
                new RequestEntity(productSaleCollection: new ProductSaleCollection()),
                new \Exception(),
                new ErrorResponse(exception: new \Exception())

            ],
        ];
    }

    private static function generateSaleCollectionNotEmpty(): ProductSaleCollection
    {
        return (new ProductSaleCollection())->addProductSale(productSaleEntity: new ProductSaleEntity(
            productId: fake()->randomDigit(),
            quantity: fake()->randomDigitNotZero(),
        ))->addProductSale(productSaleEntity: new ProductSaleEntity(
            productId: fake()->randomDigit(),
            quantity: fake()->randomDigitNotZero(),
        ));
    }
}
