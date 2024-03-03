<?php

namespace App\Repositories;

abstract class BaseRepository implements BaseRepositoryContract
{
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function all(): array
    {
        return $this->model->get()->toArray();
    }
}
