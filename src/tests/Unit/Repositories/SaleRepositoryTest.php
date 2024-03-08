<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\SaleRepository;
use App\Models\SaleProduct;
use App\Models\Product;
use App\Models\Sale;
use Tests\TestCase;

class SaleRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests the creation of a sale with products.
     *
     * @return void
     */
    public function test_create_sale_with_products()
    {
        $sale = Sale::factory()->create(['is_active' => true]);

        $product1 = Product::factory()->create();
        $product2 = Product::factory()->create();

        $productData = [
            ['product_id' => $product1->id, 'amount' => 2],
            ['product_id' => $product2->id, 'amount' => 3],
        ];

        SaleRepository::addProducts(['products' => $productData], $sale);

        $this->assertNotNull($sale->id);
        $this->assertTrue($sale->is_active);

        $this->assertCount(2, $sale->saleProduct);
        $this->assertEquals($product1->id, $sale->saleProduct[0]->product_id);
        $this->assertEquals(2, $sale->saleProduct[0]->amount);
        $this->assertEquals($product2->id, $sale->saleProduct[1]->product_id);
        $this->assertEquals(3, $sale->saleProduct[1]->amount);
    }

    /**
     * Tests obtaining a sale model by ID.
     *
     * @return void
     */
    public function test_get_model_by_id()
    {
        $sale = Sale::factory()->create();

        $result = SaleRepository::getModelById($sale->id);

        $this->assertEquals($sale->id, $result->id);
    }

    /**
     * Tests adding products to a sale.
     *
     * @return void
     */
    public function test_add_products_to_sale()
    {
        $product1 = Product::factory()->create();
        $product2 = Product::factory()->create();

        $sale = Sale::factory()->create();

        $productData = [
            'products' => [
                ['product_id' => $product1->id, 'amount' => 2],
                ['product_id' => $product2->id, 'amount' => 3],
            ],
        ];

        $result = SaleRepository::addProducts($productData, $sale);

        $this->assertCount(2, $result->saleProduct);
    }


    /**
     * Tests canceling a sale.
     *
     * @return void
     */
    public function test_cancel_sale()
    {
        $sale = Sale::factory()->create(['is_active' => true]);

        $result = SaleRepository::update(['is_active' => false], $sale);

        $this->assertFalse($result->is_active);
    }

    /**
     * Tests searching for products of a sale.
     *
     * @return void
     */
    public function test_find_sale_products()
    {
        $sale = Sale::factory()->create();
        SaleProduct::factory()->count(3)->create(['sales_id' => $sale->id]);

        $result = SaleRepository::findSaleProducts($sale->id);
        $this->assertCount(3, $result->saleProduct);

        $sale2 = Sale::factory()->create();
        SaleProduct::factory()->count(5)->create(['sales_id' => $sale2->id]);
        $result2 = SaleRepository::findSaleProducts($sale2->id, 5);
        $this->assertCount(5, $result2->saleProduct);

        $result3 = SaleRepository::findSaleProducts();
        $this->assertInstanceOf('Illuminate\Pagination\LengthAwarePaginator', $result3);
    }
}
