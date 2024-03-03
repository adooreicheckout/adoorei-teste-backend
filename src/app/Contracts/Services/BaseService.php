<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

interface BaseService
{
    public function list(array $filters): Collection|Model|Paginator|null;
}
