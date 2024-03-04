<?php

namespace Domain\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductsRepository
{
    public function findAll(): Collection;
    public function findById(int $id): Product;
}
