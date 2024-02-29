<?php

namespace App\Domain\Orders\Repositories;

use App\Domain\Orders\Entities\Order;
use Illuminate\Database\Eloquent\Collection;

interface OrderRepository
{
    public function create(array $data): Order;

    public function update(Order $order, array $data): bool;

    public function delete(Order $order): bool;

    public function getAll(): Collection;
}
