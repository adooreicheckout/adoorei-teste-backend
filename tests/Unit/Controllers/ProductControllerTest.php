<?php

namespace Tests\Unit\Controllers;

use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testListReturnsAcceptedResponse()
    {
        Product::factory()->count(5)->create();

        $response = $this->json('GET', 'api/product', ['Accept' => 'application/json']);

        $response->assertStatus(Response::HTTP_ACCEPTED);
    }

    public function testListAssertJsonCount()
    {
        Product::factory()->count(5)->create();

        $response = $this->json('GET', 'api/product', ['Accept' => 'application/json']);

        $response->assertJsonCount(5);
    }

    public function testListAssertEmpty()
    {
        $response = $this->json('GET', 'api/product', ['Accept' => 'application/json']);

        $response->assertJsonCount(0);
    }

    public function testListJsonStructure()
    {
        Product::factory()->count(1)->create();

        $response = $this->json('GET', 'api/product', ['Accept' => 'application/json']);

        $response->assertJsonStructure([
            [
                'name',
                'price',
                'description'
            ]
        ]);
    }

    public function testListRouteNotFound()
    {
        $response = $this->json('GET', 'api/product/1231', ['Accept' => 'application/json']);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
