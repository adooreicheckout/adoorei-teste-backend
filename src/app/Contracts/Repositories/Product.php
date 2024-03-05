<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;

interface Product extends BaseRepository
{
    public function getById(int $id): Model|null;
}
