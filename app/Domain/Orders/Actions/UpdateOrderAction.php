<?php

namespace App\Domain\Orders\Actions;

use App\Domain\Orders\Entities\Order;
use App\Domain\Orders\Repositories\OrderRepository;

class UpdateOrderAction
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(Order $order, array $data): void
    {
        $this->orderRepository->update($order, $data);
    }
}
