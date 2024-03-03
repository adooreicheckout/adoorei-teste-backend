<?php

namespace App\Contracts\Repositories;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseRepository
{
    public function list(array $filters): Collection|Model|Paginator|null;
}
