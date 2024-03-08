<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\ProductRepository;
use App\Models\Product;
use Tests\TestCase;

class ProductRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests the getAll method of the ProductRepository repository.
     *
     * @return void
     */
    public function test_get_all_products()
    {
        $products = Product::factory()->count(5)->create();

        $result = ProductRepository::getAll();

        $this->assertCount(5, $result);

        foreach ($products as $product) {
            $this->assertContains($product->name, $result->pluck('name'));
            $this->assertGreaterThan($product->price * 0.01, $result->pluck('price')->min());
            $this->assertContains($product->description, $result->pluck('description'));
        }
    }

    /**
     * Tests the getAll method of the ProductRepository repository with the is_available filter.
     *
     * @return void
     */
    public function test_get_available_products()
    {
        $availableProduct = Product::factory()->create(['is_available' => true]);
        $unavailableProduct = Product::factory()->create(['is_available' => false]);

        $result = ProductRepository::getAll(true);

        $this->assertContains($availableProduct->name, $result->pluck('name'));

        $this->assertNotContains($unavailableProduct->name, $result->pluck('name'));
    }
}
