<?php

namespace App\Contracts\Services;
use Illuminate\Database\Eloquent\Model;

interface Sale extends BaseService
{
    public function store(array $data): bool;
    public function update(Model $model): bool;
    public function destroy(int $id): bool;
    public function getById(int $id): Model|null;
}
