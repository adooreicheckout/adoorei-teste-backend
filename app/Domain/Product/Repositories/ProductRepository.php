<?php

namespace App\Domain\Product\Repositories;

use App\Domain\Product\Entities\Product;

interface ProductRepository
{
    public function create(array $data): Product;

    public function update(Product $product, array $data): bool;

    public function delete(Product $product): bool;
}
