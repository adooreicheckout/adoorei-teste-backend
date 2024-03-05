<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;

interface Sale extends BaseRepository
{
    public function store(array $data): bool;
    public function update(array $data): bool;
    public function destroy(Model $model): bool;
}
