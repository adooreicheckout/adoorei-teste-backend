<?php

namespace App\Domain\Orders\Repositories;

use App\Domain\Orders\Entities\Order;
use Illuminate\Database\Eloquent\Collection;

class EloquentOrderRepository implements OrderRepository
{
    public function create(array $data): Order
    {
        return Order::create($data);
    }

    public function update(Order $order, array $data): bool
    {
        return $order->update($data);
    }

    public function delete(Order $order): bool
    {
        return $order->delete();
    }

    public function getAll(): Collection
    {
        return Order::all();
    }
}
