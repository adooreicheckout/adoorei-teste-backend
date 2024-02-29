<?php

namespace App\Domain\Product\Actions;

use App\Domain\Product\Entities\Product;
use App\Domain\Product\Repositories\ProductRepository;

class UpdateProductAction
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(Product $product, array $data): void
    {
        $this->productRepository->update($product, $data);
    }
}
