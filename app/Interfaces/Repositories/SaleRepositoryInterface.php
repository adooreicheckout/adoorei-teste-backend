<?php

namespace App\Interfaces\Repositories;

use App\Models\Sale;

interface SaleRepositoryInterface extends BaseRepositoryInterface
{
    public function create(array $data): Sale;
}
