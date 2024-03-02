<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

interface BaseService
{
    public function list(array $filters): Collection|Model|Paginator|null;
    public function create(array $data): bool;

    public function update(array $data): bool;
}
