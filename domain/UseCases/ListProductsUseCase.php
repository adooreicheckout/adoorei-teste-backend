<?php

namespace Domain\UseCases;

use App\Http\Resources\ProductsResource;
use Domain\Repositories\ProductsRepository;

class ListProductsUseCase
{
    public function __construct(protected ProductsRepository $productsRepository) {}

    public function execute()
    {
        $products = $this->productsRepository->findAll();

        return ProductsResource::collection($products);
    }
}
