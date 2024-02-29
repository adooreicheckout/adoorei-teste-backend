<?php

namespace App\Interfaces\Repositories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Collection;

interface SaleRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): Sale;

    public function create(array $data): Sale;
}
