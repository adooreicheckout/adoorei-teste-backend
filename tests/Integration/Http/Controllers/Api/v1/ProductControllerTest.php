<?php

namespace Tests\Integration\Http\Controllers\Api\v1;

use Domain\Modules\Product\List\gateways\ProductGateway;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\Integration\Utils\TestDataTrait;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;
    use TestDataTrait;

    public function setUp(): void
    {
        parent::setUp();
        $this->refreshTestDatabase();
    }

    public function testShouldCallRouteAndReturnStatus200()
    {
        $expectedData = $this->getProductTestData();
        DB::table('product')->insert($expectedData);
        $this->get('api/v1/products')->assertOk()->assertJson($expectedData);

    }

    public function testShouldCallRouteAndReturnStatus500()
    {
        $this->app->bind(ProductGateway::class, function () {
            return \Mockery::mock(ProductGateway::class)
                ->shouldReceive('list')
                ->andThrow(new \Exception());
        });

        $this->get('api/v1/products')->assertInternalServerError();
    }
}
