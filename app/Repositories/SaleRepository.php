<?php

namespace App\Repositories;

use App\Interfaces\Repositories\SaleRepositoryInterface;
use App\Models\Sale;

class SaleRepository extends AbstractEloquentRepository implements SaleRepositoryInterface
{
    protected function getModelClassName(): string
    {
        return Sale::class;
    }

    public function create(array $data): Sale
    {
        return $this->createQuery()->create($data);
    }

    public function getById(int $id): Sale
    {
        return $this->createQuery()->find($id);
    }

    public function update(int $id, array $data): Sale
    {
        $sale = $this->createQuery()->find($id);
        $sale->update($data);

        return $sale->fresh();
    }

    public function delete(int $id): bool
    {
        return $this->createQuery()->find($id)->delete();
    }
}
