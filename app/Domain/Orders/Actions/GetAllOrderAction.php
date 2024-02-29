<?php

namespace App\Domain\Orders\Actions;

use App\Domain\Orders\Repositories\OrderRepository;
use Illuminate\Database\Eloquent\Collection;

class GetAllOrderAction
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(): Collection
    {
        return $this->orderRepository->getAll();
    }
}
