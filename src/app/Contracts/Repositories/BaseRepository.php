<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

interface BaseRepository
{

    public function list(array $filters): Collection|Model|Paginator|null;
    public function store(Model $model): bool;
    public function destroy(Model $model): bool;
}
