<?php

namespace Tests\Unit\Controllers;

use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

class SaleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testListSaleResponseStatus()
    {
        $response = $this->json('GET', 'api/sale', ['Accept' => 'application/json']);

        $response->assertStatus(Response::HTTP_ACCEPTED);
    }

    public function testCreateSaleResponseStatus()
    {
        $product = Product::factory()->count(1)->create();

        $products = [
            "products" => [
                [
                    "product_id" => $product->first()->id,
                    "amount" => 1
                ]
            ]
        ];

        $response = $this->json(
            'POST',
            'api/sale',
            $products,
            ['Accept' => 'application/json']
        );

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function testCreateSaleProductNotFoundResponseStatus()
    {
        $products = [
            "products" => [
                [
                    "product_id" => 1,
                    "amount" => 1
                ], [
                    "product_id" => 2,
                    "amount" => 2
                ]
            ]
        ];

        $response = $this->json('POST', 'api/sale', $products, ['Accept' => 'application/json']);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testListAssertEmpty()
    {
        $response = $this->json('GET', 'api/sale', ['Accept' => 'application/json']);

        $response->assertJsonCount(0);
    }

    public function testCreateSaleReponseJsonStructure()
    {
        $product = Product::factory()->count(1)->create();

        $products = [
            "products" => [
                [
                    "product_id" => $product->first()->id,
                    "amount" => 1
                ]
            ]
        ];

        $response = $this->json(
            'POST',
            'api/sale',
            $products,
            ['Accept' => 'application/json']
        );

        $response->assertJsonStructure([
            "sales_id",
            "amount",
            "products" => [
                [
                    "product_id",
                    "nome",
                    "price",
                    "amount"
                ]
            ]
        ]);
    }

    public function testListSaleReponseJsonStructure()
    {
        $product = Product::factory()->count(1)->create();

        $products = [
            "products" => [
                [
                    "product_id" => $product->first()->id,
                    "amount" => 1
                ]
            ]
        ];

        $this->json(
            'POST',
            'api/sale',
            $products,
            ['Accept' => 'application/json']
        );

        $response = $this->json('GET', 'api/sale', ['Accept' => 'application/json']);

        $response->assertJsonStructure([
            [
                "sales_id",
                "amount",
                "products" =>
                [
                    [
                        "product_id",
                        "nome",
                        "price",
                        "amount"
                    ]
                ]
            ]
        ]);
    }

    public function testListRouteNotFound()
    {
        $response = $this->json('GET', 'api/sale/1231', ['Accept' => 'application/json']);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testGetSaleByIdResponseStatus()
    {
        $product = Product::factory()->count(1)->create();

        $products = [
            "products" => [
                [
                    "product_id" => $product->first()->id,
                    "amount" => 1
                ]
            ]
        ];

        $responseSale = $this->json(
            'POST',
            'api/sale',
            $products,
            ['Accept' => 'application/json']
        );

        $salesId = json_decode($responseSale->getContent())->sales_id;

        $response = $this->json('GET', 'api/sale/get-by-id', ["sales_id" => $salesId], ['Accept' => 'application/json']);

        $response->assertStatus(Response::HTTP_ACCEPTED);
    }

    public function testCancelSaleResponseStatusSuccess()
    {
        $product = Product::factory()->count(1)->create();

        $products = [
            "products" => [
                [
                    "product_id" => $product->first()->id,
                    "amount" => 1
                ]
            ]
        ];

        $responseSale = $this->json(
            'POST',
            'api/sale',
            $products,
            ['Accept' => 'application/json']
        );

        $salesId = json_decode($responseSale->getContent())->sales_id;

        $response = $this->json('DELETE', 'api/sale/', ["sales_id" => $salesId], ['Accept' => 'application/json']);

        $response->assertStatus(Response::HTTP_ACCEPTED);
    }

    public function testCancelSaleResponseNotFoundStatus()
    {
        $response = $this->json('DELETE', 'api/sale/', ["sales_id" => 0], ['Accept' => 'application/json']);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testUpdateSaleResponseStatusSuccess()
    {
        $product = Product::factory()->count(1)->create();

        $products = [
            "products" => [
                [
                    "product_id" => $product->first()->id,
                    "amount" => 1
                ]
            ]
        ];

        $responseSale = $this->json(
            'POST',
            'api/sale',
            $products,
            ['Accept' => 'application/json']
        );

        $salesId = json_decode($responseSale->getContent())->sales_id;
        $productsUpdate = [
            "products" => [
                [
                    "product_id" => $product->first()->id,
                    "amount" => 3
                ]
            ]
        ];

        $update = array_merge(["sales_id" => $salesId], $productsUpdate);

        $response = $this->json('PATCH', 'api/sale/', $update, ['Accept' => 'application/json']);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function testUpdateSaleResponseNotFoundStatus()
    {
        $response = $this->json('PATCH', 'api/sale/', ["sales_id" => 0], ['Accept' => 'application/json']);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
