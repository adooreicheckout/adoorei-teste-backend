<?php

namespace App\Services;

use App\Contracts\Services\Product as ProductServiceContract;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use \Illuminate\Contracts\Pagination\Paginator;

class ProductService implements ProductServiceContract
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function list(array $filters): Collection|Model|Paginator|null
    {
        return $this->productRepository->list($filters);
    }

    public function getById(int $id): Model|null
    {
        return $this->productRepository->getById($id);
    }

}
