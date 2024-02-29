<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BaseRepositoryInterface;

abstract class AbstractRepository implements BaseRepositoryInterface
{
    protected abstract function getModelClassName(): string;
}
