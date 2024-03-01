<?php

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface BaseRepositoryInterface
{
    public function getAll(): Collection;
}
