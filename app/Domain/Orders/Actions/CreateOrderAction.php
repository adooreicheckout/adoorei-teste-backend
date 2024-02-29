<?php

namespace App\Domain\Orders\Actions;

use App\Domain\Orders\Repositories\OrderRepository;
use App\Domain\Orders\Validators\OrderValidator;
use App\Domain\Orders\DTO\CreateOrderDTO;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateOrderAction
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(CreateOrderDTO $createOrderDTO)
    {

        $validatedData = $createOrderDTO->validate();
        $validator = OrderValidator::validateCreate($validatedData);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'data'      => $validator->errors()
            ],400));
        }


        return $this->orderRepository->create($validatedData);
    }
}
