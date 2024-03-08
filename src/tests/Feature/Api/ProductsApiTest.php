<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use Tests\TestCase;

class ProductsApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test a successful request to get a list of products.
     *
     * @return void
     */
    public function testGetProducts()
    {
        Product::factory()->count(5)->create();

        $response = $this->get('/api/products');

        $response->assertStatus(200);
    }

    /**
     * Test a request with parameters to get a list of products.
     *
     * @return void
     */
    public function testGetProductsWithParameters()
    {
        Product::factory()->count(5)->create();

        $response = $this->get('/api/products?limit=10&page=1&is_available=true');

        $response->assertStatus(200);
    }

    /**
     * Test when no content is available.
     *
     * @return void
     */
    public function testNoContent()
    {
        $response = $this->get('/api/products');

        $response->assertStatus(204);
    }
}
