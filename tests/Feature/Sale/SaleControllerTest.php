<?php

namespace Tests\Feature\Sale;

use App\Enums\Messages\Message;
use App\Models\Sale\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class SaleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_store_method_is_working()
    {
        $this->createSaleByRoute();
    }

    public function test_if_show_method_is_working()
    {
        $this->createSaleByRoute();
        $response = $this->get('/api/sales/1');
        $this->hasPatternSuccessApi($response);
        $content = $response['content'];
        $this->assertNotEmpty($content);
        $this->assertArrayHasKey('products', $content);
        $this->assertNotEmpty($content['products']);
    }

    public function test_if_index_method_is_working(): void
    {
        $this->createSaleByRoute();
        $response = $this->getJson('/api/sales');
        $this->hasPatternSuccessApi($response);
        $content = $response['content'];
        $this->assertNotEmpty($content['data']);
        $this->assertArrayHasKey('products', $content['data'][0]);
        $this->assertNotEmpty($content['data'][0]);
    }

    public function test_filter_by_amount_gt_on_list_is_working()
    {
        $this->createManyForUseFilterAmount();
        $response = $this->structureFilterByAmount('gt');
        $this->assertTrue($response['data'][0]['amount'] > 200);
    }

    public function test_filter_by_amount_gte_on_list_is_working()
    {
        $this->createManyForUseFilterAmount();
        $response = $this->structureFilterByAmount('gte', 2);
        $this->assertTrue($response['data'][0]['amount'] > 200);
        $this->assertTrue($response['data'][1]['amount'] == 200);
    }

    public function test_filter_by_amount_lt_on_list_is_working()
    {
        $this->createManyForUseFilterAmount();
        $response = $this->structureFilterByAmount('lt');
        $this->assertTrue($response['data'][0]['amount'] < 200);
    }

    public function test_filter_by_amount_lte_on_list_is_working()
    {
        $this->createManyForUseFilterAmount();
        $response = $this->structureFilterByAmount('lte', 2);
        $this->assertTrue($response['data'][0]['amount'] == 200);
        $this->assertTrue($response['data'][1]['amount'] < 200);
    }

    public function test_filter_by_amount_eq_on_list_is_working()
    {
        $this->createManyForUseFilterAmount();
        $response = $this->structureFilterByAmount('eq');
        $this->assertTrue($response['data'][0]['amount'] == 200);
    }

    public function test_filter_by_amount_ne_on_list_is_working()
    {
        $this->createManyForUseFilterAmount();
        $response = $this->structureFilterByAmount('ne', 2);
        $this->assertTrue($response['data'][0]['amount'] != 200);
        $this->assertTrue($response['data'][1]['amount'] != 200);
    }

    public function test_filter_by_amount_in_on_list_is_working()
    {
        $this->createManyForUseFilterAmount();
        $queryParam = ['amount[in]' => '[100,200]'];
        $response = $this->structureFilterByAmount('in', 2, $queryParam);
        $this->assertTrue($response['data'][0]['amount'] == 200);
        $this->assertTrue($response['data'][1]['amount'] == 100);
    }

    private function structureFilterByAmount(
        string $operator,
        int $dataLength = 1,
        array $queryParam = []
    ) {
        $queryParam = empty($queryParam) ? ["amount[{$operator}]" => 200] : $queryParam;
        $queryParam = http_build_query($queryParam);

        $request = $this->indexRequest('/api/sales?' . $queryParam);
        $data = $request['data'];

        $this->assertNotEmpty($data);
        $this->assertArrayNotHasKey($dataLength, $data);
        $this->assertCount($dataLength, $data);

        return $request;
    }

    private function createSaleByRoute()
    {
        $response = $this->post('/api/sales', [
            'products' => [
                ['product_id' => 1, 'amount' => 2]
            ]
        ]);
        $this->hasPatternSuccessApi($response, Message::CREATED, Response::HTTP_CREATED);
        $content = $response['content'];
        $this->assertNotEmpty($content);
        $this->assertArrayHasKey('products', $content);
        $this->assertNotEmpty($content['products']);

        return $response;
    }

    private function createSaleByModel(float $amount)
    {
        return Sale::create(['amount' => $amount]);
    }

    private function createManyForUseFilterAmount()
    {
        return [
            '100' => $this->createSaleByModel(100),
            '200' => $this->createSaleByModel(200),
            '300' => $this->createSaleByModel(300)
        ];
    }
}
