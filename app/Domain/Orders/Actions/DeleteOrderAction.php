<?php

namespace App\Domain\Orders\Actions;

use App\Domain\Orders\Entities\Order;
use App\Domain\Orders\Repositories\OrderRepository;

class DeleteOrderAction
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(Order $order): void
    {
        $this->orderRepository->delete($order);
    }
}
