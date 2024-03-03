<?php

namespace App\Repositories;
use App\Contracts\Repositories\Product as ProductContract;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use App\Models\Product;
//use Illuminate\Pagination\LengthAwarePaginator;
use \Illuminate\Contracts\Pagination\Paginator;

class ProductRepository implements ProductContract
{

    public function modalQuery(): Builder
    {
        return Product::query();
    }
    public function list(array $filters): Collection|Model|Paginator|null
    {
        $query = $this->modalQuery();
        $query->select('name', 'price', 'description');
        if (isset($filters['id'])) {
            return $query->where('product_id', $filters['id'])->first();
        }
        if (isset($filters['perpage'])) {
            return $query->simplePaginate($filters['perpage']);
        }
        return $query->get();
    }

    public function getById(int $id): Model|null
    {
        return $this->list(['id' => $id]);
    }
}
