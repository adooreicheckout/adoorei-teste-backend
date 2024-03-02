<?php

namespace App\Services;

use App\Contracts\Services\Sale as SaleContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class SaleService implements SaleContract
{

    public function list(array $filters): Collection|Model|Paginator
    {
        // TODO: Implement list() method.
    }

    public function create(array $data): bool
    {
        // TODO: Implement create() method.
    }

    public function update(array $data): bool
    {
        // TODO: Implement update() method.
    }

    public function destroy(int $id): bool
    {
        // TODO: Implement destroy() method.
    }
}
