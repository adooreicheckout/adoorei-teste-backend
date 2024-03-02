<?php

namespace App\Repositories;
use App\Contracts\Repositories\Product as ProductContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\Product;

class ProductRepository implements ProductContract
{

    public function list(array $filters): Collection|Model|Paginator|null
    {
        if (isset($filters['id'])) {
            return (new Product())->find($filters['id']);
        }
        return (new Product())->all()->select('name', 'price', 'description');

    }

    public function store(Model $model): bool
    {
        // TODO: Implement store() method.
    }

    public function destroy(Model $model): bool
    {
        // TODO: Implement destroy() method.
    }
}
