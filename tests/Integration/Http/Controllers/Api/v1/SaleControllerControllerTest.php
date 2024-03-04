<?php

namespace Tests\Integration\Http\Controllers\Api\v1;

use Domain\Modules\Product\List\gateways\ProductGateway;
use Domain\Modules\Sale\Create\Gateways\CreateSaleGateway;
use Domain\Modules\Sale\List\Gateways\ListSalesGateway;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\Integration\Utils\TestDataTrait;
use Tests\TestCase;

class SaleControllerControllerTest extends TestCase
{
    use RefreshDatabase;
    use TestDataTrait;

    public function setUp(): void
    {
        parent::setUp();
        $this->refreshTestDatabase();
    }

    public function testShouldCallCreateSaleRouteAndReturnStatus201()
    {
        $baseData = $this->getProductTestData();
        DB::table('product')->insert($baseData);

        $request = [
            "products" => [
                [
                    "product_id" => $baseData[0]['id'],
                    "quantity" => 10
                ],
                [
                    "product_id" => $baseData[1]['id'],
                    "quantity" => 2
                ]
            ]
        ];

        $response = $this->post('api/v1/sales', $request)->assertCreated();
        $saleUuid = json_decode($response->getContent(), true);

        $this->assertDatabaseCount('sale', 1);
        $this->assertDatabaseCount('product_sale', 2);
        $this->assertDatabaseHas('sale', [
            'id' => $saleUuid['sale_id']
        ]);
    }

    public function testShouldCallCreateSaleRouteAndReturnStatus500()
    {
        $this->app->bind(CreateSaleGateway::class, function () {
            return \Mockery::mock(CreateSaleGateway::class)
                ->shouldReceive('registerNewSale')
                ->andThrow(new \Exception());
        });
        $baseData = $this->getProductTestData();
        DB::table('product')->insert($baseData);

        $request = [
            "products" => [
                [
                    "product_id" => $baseData[0]['id'],
                    "quantity" => 10
                ],
                [
                    "product_id" => $baseData[1]['id'],
                    "quantity" => 2
                ]
            ]
        ];

        $response = $this->post('api/v1/sales', $request)->assertInternalServerError();
    }


    /**
     * @dataProvider createSale422StatusDataProvider
     */
    public function testShouldCallCreateSaleRouteAndReturnStatus422(array $request)
    {
        $this->post('api/v1/sales', $request)->assertUnprocessable();
    }

    public function testShouldCallListSaleRouteAndReturnStatus500()
    {
        $this->app->bind(ListSalesGateway::class, function () {
            return \Mockery::mock(ListSalesGateway::class)
                ->shouldReceive('list')
                ->andThrow(new \Exception());
        });

        $this->get('api/v1/sales')->assertInternalServerError();
    }

    public static function createSale422StatusDataProvider()
    {
        return [
            [
                "products" => [
                    [
                        "product_id" => -1,
                        "quantity" => 10
                    ]
                ]
            ],
            [
                "products" => [

                    [
                        "product_id" => 1,
                        "quantity" => -1
                    ]
                ]
            ], [
                "produc" => [
                    [
                        "product_id" => 1,
                        "quantity" => 10
                    ],

                ]
            ]
        ];
    }
}
