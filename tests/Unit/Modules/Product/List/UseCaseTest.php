<?php

namespace Tests\Unit\Modules\Product\List;

use Domain\Generics\Instrumentation\UseCaseInstrumentation;
use Domain\Generics\Logger\Logger;
use Domain\Generics\Responses\ErrorResponse;
use Domain\Modules\Product\List\Collection\ProductCollection;
use Domain\Modules\Product\List\Entities\Product;
use Domain\Modules\Product\List\gateways\ProductGateway;
use Domain\Modules\Product\List\Responses\SuccessResponse;
use Domain\Modules\Product\List\UseCase;
use Mockery;
use PHPUnit\Framework\TestCase;

class UseCaseTest extends TestCase
{
    private UseCaseInstrumentation $instrumentationMock;
    private ProductGateway $productGatewayMock;
    private Logger $loggerMock;
    private UseCase $useCase;

    public function setUp(): void
    {
        $this->instrumentationMock = Mockery::mock(UseCaseInstrumentation::class);
        $this->productGatewayMock = Mockery::mock(ProductGateway::class);
        $this->loggerMock = Mockery::mock(Logger::class);
        $this->useCase = new UseCase(
            instrumentation: $this->instrumentationMock,
            logger: $this->loggerMock,
            productGateway: $this->productGatewayMock
        );
    }

    /**
     * @dataProvider useCaseSuccessDataProvider
     */
    public function testShouldExecuteUseCaseWithSuccess(
        ProductCollection $expectedList,
        SuccessResponse   $expectedUseCaseResponse
    ) {
        $this->instrumentationMock->shouldReceive('useCaseStarted')->withNoArgs()->once();
        $this->instrumentationMock->shouldReceive('useCaseFinished')->withNoArgs()->once();
        $this->productGatewayMock->shouldReceive('list')->withNoArgs()->andReturn($expectedList);
        $useCaseResponse = $this->useCase->execute();
        $this->assertEquals($expectedUseCaseResponse, $useCaseResponse);
    }

    /**
     * @dataProvider useCaseExceptionDataProvider
     */
    public function testShouldExecuteUseCaseWithException(
        \Throwable    $expectedException,
        ErrorResponse $expectedUseCaseResponse
    ) {
        $this->instrumentationMock->shouldReceive('useCaseStarted')->withNoArgs()->once();
        $this->instrumentationMock->shouldReceive('useCaseFailed')->with($expectedException)->once();
        $this->productGatewayMock->shouldReceive('list')->withNoArgs()->andThrow($expectedException);
        $this->loggerMock->shouldReceive('error')->withArgs(["",[$expectedException]])->once();
        $useCaseResponse = $this->useCase->execute();
        $this->assertEquals($expectedUseCaseResponse, $useCaseResponse);
    }

    public static function useCaseSuccessDataProvider()
    {
        $productCollection = self::generateProductCollectionNotEmpty();
        return [
            [
                new ProductCollection(),
                new SuccessResponse(productCollection: new ProductCollection())

            ],
            [
                $productCollection,
                new SuccessResponse(productCollection: $productCollection)
            ],
        ];
    }

    public static function useCaseExceptionDataProvider()
    {

        return [
            [
                new \DomainException(),
                new ErrorResponse(exception: new \DomainException())

            ],
            [
                new \Exception(),
                new ErrorResponse(exception: new \Exception())

            ],

        ];
    }

    private static function generateProductCollectionNotEmpty()
    {
        return (new ProductCollection())->addProduct(new Product(
            id: fake()->randomDigitNot(0),
            name: "Produto " . fake()->randomDigitNot(0),
            price: fake()->randomFloat(),
            description: fake()->text
        ));
    }
}
