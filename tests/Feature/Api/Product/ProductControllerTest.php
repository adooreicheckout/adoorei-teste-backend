<?php

namespace Tests\Feature\Api\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_list_is_working(): void
    {
        $response = $this->getJson('/api/products');
        $this->hasPatternSuccessApi($response);
        $content = $response['content'];
        $this->assertNotEmpty($content['data']);
    }

    public function test_filter_by_name_on_list_is_working()
    {
        $queryParam = http_build_query([
            'name[lk]' => '13',
        ]);

        $request = $this->indexRequest('/api/products?' . $queryParam);
        $data = $request['data'];
        $this->assertNotEmpty($data);
        $this->assertEquals($data[0]['name'], 'Apple iPhone 13 (128 GB) - Luz das estrelas');
    }

    public function test_filter_by_price_gt_on_list_is_working()
    {
        $this->structureFilterByPrice('gt', 'Apple iPhone 14 (128 GB) – Estelar');
    }

    public function test_filter_by_price_gte_on_list_is_working()
    {
        $this->structureFilterByPrice('gte', 'Apple iPhone 13 (128 GB) - Luz das estrelas', 0, 2);
    }

    public function test_filter_by_price_lt_on_list_is_working()
    {
        $this->structureFilterByPrice('lt', 'iPhone 11 Apple 64GB Preto 6,1” 12MP iOS');
    }

    public function test_filter_by_price_lte_on_list_is_working()
    {
        $this->structureFilterByPrice('lte', 'Apple iPhone 13 (128 GB) - Luz das estrelas', 1, 2);
    }

    public function test_filter_by_price_eq_on_list_is_working()
    {
        $this->structureFilterByPrice('eq', 'Apple iPhone 13 (128 GB) - Luz das estrelas');
    }

    public function test_filter_by_price_ne_on_list_is_working()
    {
        $this->structureFilterByPrice('ne', 'iPhone 11 Apple 64GB Preto 6,1” 12MP iOS', 0, 2);
    }

    public function test_filter_by_price_in_on_list_is_working()
    {
        $queryParam = [
            'price[in]' => '[2681.10,3749]'
        ];

        $this->structureFilterByPrice('in', 'iPhone 11 Apple 64GB Preto 6,1” 12MP iOS', 0, 2, $queryParam);
    }

    private function structureFilterByPrice(
        string $operator,
        string $nameCompare,
        int $indexData = 0,
        int $dataLength = 1,
        array $queryParam = []
    ) {
        $queryParam = empty($queryParam) ? ["price[{$operator}]" => 3749] : $queryParam;
        $queryParam = http_build_query($queryParam);

        $request = $this->indexRequest('/api/products?' . $queryParam);
        $data = $request['data'];

        $this->assertNotEmpty($data);
        $this->assertArrayNotHasKey($dataLength, $data);
        $this->assertEquals($data[$indexData]['name'], $nameCompare);
        $this->assertCount($dataLength, $data);

        return $request;
    }
}
