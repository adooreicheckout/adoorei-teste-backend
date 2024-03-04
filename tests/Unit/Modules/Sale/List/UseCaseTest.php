<?php

namespace Tests\Unit\Modules\Sale\List;

use Domain\Generics\Instrumentation\UseCaseInstrumentation;
use Domain\Generics\Logger\Logger;
use Domain\Generics\Responses\ErrorResponse;
use Domain\Modules\Sale\List\Collections\ProductSaleCollection;
use Domain\Modules\Sale\List\Collections\SaleCollection;
use Domain\Modules\Sale\List\Entities\ProductSaleEntity;
use Domain\Modules\Sale\List\Entities\SaleEntity;
use Domain\Modules\Sale\List\Gateways\ListSalesGateway;
use Domain\Modules\Sale\List\Responses\SuccessResponse;
use Domain\Modules\Sale\List\UseCase;
use Mockery;
use PHPUnit\Framework\TestCase;

class UseCaseTest extends TestCase
{
    private UseCaseInstrumentation $instrumentationMock;
    private ListSalesGateway $listSalesGatewayMock;
    private Logger $loggerMock;
    private UseCase $useCase;

    public function setUp(): void
    {
        $this->instrumentationMock = Mockery::mock(UseCaseInstrumentation::class);
        $this->listSalesGatewayMock = Mockery::mock(ListSalesGateway::class);
        $this->loggerMock = Mockery::mock(Logger::class);
        $this->useCase = new UseCase(
            saleGateway: $this->listSalesGatewayMock,
            logger: $this->loggerMock,
            instrumentation: $this->instrumentationMock
        );
    }

    /**
     * @dataProvider useCaseSuccessDataProvider
     */
    public function testShouldExecuteUseCaseWithSuccess(
        SaleCollection  $expectedList,
        SuccessResponse $expectedUseCaseResponse
    ) {
        $this->instrumentationMock->shouldReceive('useCaseStarted')->withNoArgs()->once();
        $this->instrumentationMock->shouldReceive('useCaseFinished')->withNoArgs()->once();
        $this->listSalesGatewayMock->shouldReceive('list')->withNoArgs()->andReturn($expectedList);
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
        $this->listSalesGatewayMock->shouldReceive('list')->withNoArgs()->andThrow($expectedException);
        $this->loggerMock->shouldReceive('error')->withArgs(["", [$expectedException]]);
        $useCaseResponse = $this->useCase->execute();
        $this->assertEquals($expectedUseCaseResponse, $useCaseResponse);
    }

    public static function useCaseSuccessDataProvider(): array
    {
        $salesCollection = self::generateSaleCollectionNotEmpty();
        return [
            [
                new SaleCollection(),
                new SuccessResponse(sales: new SaleCollection())

            ],
            [
                $salesCollection,
                new SuccessResponse(sales: $salesCollection)

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

    private static function generateSaleCollectionNotEmpty()
    {
        return (new SaleCollection())->addSale(new SaleEntity(
            fake()->uuid,
            fake()->randomFloat(),
            products: (new ProductSaleCollection())->addProductSale(
                new ProductSaleEntity(
                    fake()->randomDigit(),
                    "Produto " . fake()->randomDigitNot(0),
                    fake()->randomFloat(),
                    fake()->randomDigitNot(0)
                )
            )
        ));
    }
}
