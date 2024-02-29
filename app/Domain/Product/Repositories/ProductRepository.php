<?php

namespace App\Domain\Product\Repositories;

use App\Domain\Product\Entities\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepository
{
    public function create(array $data): Product;

    public function update(Product $product, array $data): bool;

    public function delete(Product $product): bool;

    public function getAll(): Collection;
}
