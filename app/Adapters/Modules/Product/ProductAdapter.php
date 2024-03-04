<?php

namespace App\Adapters\Modules\Product;

use Domain\Modules\Product\List\Collection\ProductCollection;
use Domain\Modules\Product\List\Entities\Product;
use Domain\Modules\Product\List\gateways\ProductGateway;
use Illuminate\Support\Facades\DB;

class ProductAdapter implements ProductGateway
{
    public function list(): ProductCollection
    {
        $products = DB::table('product')->select([
            'id',
            'name',
            'price',
            'description'
        ])->get()->toArray();

        $productCollection = new ProductCollection();
        foreach ($products as $product) {
            $productCollection->addProduct(new Product(
                id: $product->id,
                name: $product->name,
                price: $product->price,
                description: $product->description
            ));
        }
        return $productCollection;
    }
}
