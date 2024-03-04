<?php

namespace App\Repositories\Products\Contracts;

use App\Repositories\BaseRepositoryContract;

interface ProductRepositoryContract extends BaseRepositoryContract
{
    public function getById(string $id): Object;
}
