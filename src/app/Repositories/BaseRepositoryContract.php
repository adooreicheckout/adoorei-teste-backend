<?php

namespace App\Repositories;

interface BaseRepositoryContract
{
    public function store(array $data);

    public function all(): array;
}
