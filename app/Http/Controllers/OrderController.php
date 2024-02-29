<?php

namespace App\Http\Controllers;

use App\Domain\Orders\Actions\CreateOrderAction;
use App\Domain\Orders\Actions\DeleteOrderAction;
use App\Domain\Orders\Actions\GetAllOrderAction;
use App\Domain\Orders\Actions\UpdateOrderAction;
use App\Domain\Orders\DTO\CreateOrderDTO;
use App\Domain\Orders\DTO\UpdateOrderDTO;
use App\Domain\Orders\Entities\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $createOrderAction;
    protected $updateOrderAction;
    protected $deleteOrderAction;
    protected $getAllOrderAction;

    public function __construct(
        CreateOrderAction $createOrderAction,
        UpdateOrderAction $updateOrderAction,
        DeleteOrderAction $deleteOrderAction,
        GetAllOrderAction $getAllOrderAction
    ) {
        $this->createOrderAction = $createOrderAction;
        $this->updateOrderAction = $updateOrderAction;
        $this->deleteOrderAction = $deleteOrderAction;
        $this->getAllOrderAction = $getAllOrderAction;
    }

    public function create(Request $request): JsonResponse
    {

        $createOrderDTO = new CreateOrderDTO(
            $request->input('amount'),
            $request->input('status'),
        );

        $order = $this->createOrderAction->execute($createOrderDTO);

        return response()->json(['order' => $order], 201);
    }

    public function update(Order $order, Request $request): JsonResponse
    {
        $updateProductDTO = new UpdateOrderDTO(
            $request->input('amount'),
            $request->input('status'),
        );

        $validatedData = $updateProductDTO->validate();

        $this->updateOrderAction->execute($order, $validatedData);

        return response()->json(['message' => 'Product updated successfully'], 200);
    }

    public function delete(Order $order): JsonResponse
    {
        $this->deleteOrderAction->execute($order);

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    public function index(): JsonResponse
    {
        $orders = $this->getAllOrderAction->execute();

        return response()->json(['orders' => $order], 200);
    }
}
