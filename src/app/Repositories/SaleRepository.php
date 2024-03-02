<?php

namespace App\Repositories;

use App\Contracts\Repositories\Sale as SaleContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SaleRepository implements SaleContract
{

    public function list(array $filters): Collection|Model
    {
        // TODO: Implement list() method.
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
