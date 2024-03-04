<?php

namespace Domain\Repositories;

use App\Models\ProductSale;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Collection;

interface SalesRepository
{
    public function create(array $data): Sale;
    public function findById(int $saleId): Sale;
    public function findByIdWithProducts(int $saleId): Sale;
    public function findAll(): Collection;
    public function update(array $data, Sale $sale): Sale;
    public function createProductsBySale(array $data, int $saleId): ProductSale;
}
