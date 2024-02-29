<?php

namespace App\Services;

use App\Interfaces\Repositories\ProductRepositoryInterface;

class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $productRepositoryInterface
    ) {
    }

    public function list()
    {
        $list = $this->productRepositoryInterface->getAll();

        return $list;
    }
}
