<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BaseRepositoryInterface;

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

    public function getAll()
    {
        return $this->createQuery()->paginate();
    }
}
