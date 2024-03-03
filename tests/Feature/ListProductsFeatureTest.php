<?php

namespace Tests\Feature;

use App\Database\Repositories\Eloquent\EloquentProductsRepository;
use App\Models\Product;
use Domain\UseCases\ListProductsUseCase;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class ListProductsFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_list_products_feature_test(): void
    {
        Product::create([
            'name' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 100,
        ]);

        Product::create([
            'name' => 'Product 2',
            'description' => 'Product 2 description',
            'price' => 100,
        ]);

        $this->get('/api/products')
            ->assertStatus(200)
            ->assertJsonCount(2);

    }

}
