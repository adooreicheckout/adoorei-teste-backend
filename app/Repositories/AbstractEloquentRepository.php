<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

abstract class AbstractEloquentRepository extends AbstractRepository implements BaseRepositoryInterface
{
    protected function createQuery()
    {
        return app($this->getModelClassName())->newQuery();
    }

    public function findOrFail(int $id)
    {
        return $this->createQuery()->findOrFail($id);
    }

    public function getById(int $id)
    {
        return $this->createQuery()->find($id);
    }

    public function getAll(): Collection
    {
        return $this->createQuery()->get();
    }
}
