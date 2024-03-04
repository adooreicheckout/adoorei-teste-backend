<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface BaseRepositoryContract
{
    public function store(array $data): Model;

    public function all(): array;

    public function getWithRelation(string $relation);

    public function getByAttribute(string $field, string $attribute, array $relation = []): Collection;

    public function updateById(array $data, array $field);
}
