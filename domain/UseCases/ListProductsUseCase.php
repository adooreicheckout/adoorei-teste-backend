<?php

namespace Domain\UseCases;

use Domain\Repositories\ProductsRepository;

class ListProductsUseCase
{
    public function __construct(protected ProductsRepository $productsRepository) {}

    public function execute()
    {
        $products = $this->productsRepository->findAll();

        return $products;
    }
}
