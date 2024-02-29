<?php

namespace App\Domain\Product\Actions;

use App\Domain\Product\Entities\Product;
use App\Domain\Product\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;

class GetAllProductsAction
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(): Collection
    {
        return $this->productRepository->getAll();
    }
}
