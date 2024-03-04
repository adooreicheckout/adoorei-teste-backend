<?php

namespace App\Services\Products;

use App\Services\Products\Contracts\ProductServiceContract;
use App\Repositories\Products\Contracts\ProductRepositoryContract;

class ProductService implements ProductServiceContract
{
    private $productRepository;

    public function __construct(ProductRepositoryContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function get(): array
    {
        return $this->productRepository->all();
    }
}
