<?php

namespace Domain\UseCases;

use App\Database\Repositories\ProductsRepository;
use App\Http\Resources\ProductsResource;

class ListProductsUseCase
{
    public function __construct(protected ProductsRepository $productsRepository) {}

    public function execute()
    {
        $products = $this->productsRepository->findAll();

        return ProductsResource::collection($products);
    }
}
