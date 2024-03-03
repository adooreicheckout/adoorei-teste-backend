<?php

namespace Domain\UseCases;

use App\Models\Sale;
use Domain\Repositories\ProductsRepository;
use Domain\Repositories\SalesRepository;
use Exception;

class CreateSaleUseCase
{
    public function __construct(
        protected SalesRepository $salesRepository,
        protected ProductsRepository $productsRepository
    ) {}

    public function execute($data)
    {
        $sale = $this->salesRepository->create([
            'status' => Sale::STATUS_PENDING,
            'amount' => null,
        ]);

        $totalAmoundOfTheSale = 0;
        foreach ($data['products'] as $productFromRequest) {
            $productFromRepo = $this->productsRepository->findById($productFromRequest['id']);

            $this->salesRepository->createProductsBySale([
                'product_id' => $productFromRepo->id,
                'price' => $productFromRepo->price,
                'amount' => $productFromRequest['amount'],
            ], $sale->id);

            $totalAmoundOfTheSale += $productFromRepo->price * $productFromRequest['amount'];
        }

        $sale = $this->salesRepository->update([
            'amount' => $totalAmoundOfTheSale,
            'status' => Sale::STATUS_COMPLETED,
        ], $sale);

        return $sale;
    }
}
