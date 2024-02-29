<?php

namespace App\Repositories;

use App\Interfaces\Repositories\SaleProductRepositoryInterface;
use App\Models\SaleProduct;

class SaleProductRepository extends AbstractEloquentRepository implements SaleProductRepositoryInterface
{
    protected function getModelClassName(): string
    {
        return SaleProduct::class;
    }
    
    public function create(array $data): SaleProduct
    {
        return $this->createQuery()->create($data);
    }
}
