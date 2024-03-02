<?php

namespace App\Services;

use App\Contracts\Services\Product as ProductServiceContract;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use PhpOption\None;

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

    public function create(array $data): bool
    {
        // TODO: Implement create() method.
    }

    public function update(array $data): bool
    {
        // TODO: Implement update() method.
    }

    public function destroy($id): bool
    {
        // TODO: Implement destroy() method.
    }
}
