<?php

namespace Domain\UseCases;

use Domain\Repositories\ProductsRepository;
use Illuminate\Database\Eloquent\Collection;

class ListProductsUseCase
{
    public function __construct(protected ProductsRepository $productsRepository) {}

    public function execute(): Collection
    {
        $products = $this->productsRepository->findAll();

        return $products;
    }
}
