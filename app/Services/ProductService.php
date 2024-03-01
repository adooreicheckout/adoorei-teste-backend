<?php

namespace App\Services;

use App\Interfaces\Repositories\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $productRepositoryInterface
    ) {
    }

    public function list(): Collection
    {
        $list = $this->productRepositoryInterface->getAll();

        return $list;
    }
}
