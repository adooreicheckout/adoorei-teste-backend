<?php

namespace App\Repositories\Sales\Contracts;

use App\Repositories\BaseRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

interface SaleRepositoryContract extends BaseRepositoryContract
{
    public function getSales(array $relations): Collection;
}
