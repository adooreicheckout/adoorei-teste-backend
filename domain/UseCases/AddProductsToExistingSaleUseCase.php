<?php

namespace Domain\UseCases;

use App\Exceptions\SaleAlreadyCanceledException;
use App\Models\Sale;
use Domain\Repositories\ProductsRepository;
use Domain\Repositories\SalesRepository;
use Exception;

class AddProductsToExistingSaleUseCase
{
    public function __construct(
        protected SalesRepository $salesRepository,
        protected ProductsRepository $productsRepository
    ) {}

    public function execute($data, $id)
    {
        $sale = $this->salesRepository->findByIdWithProducts($id);

        if ($sale->status === Sale::STATUS_CANCELLED) {
            throw new SaleAlreadyCanceledException("Sale already cancelled! You can't add new products to a cancelled sale.");
        }

        $totalAmoundOfTheSale = $sale->amount;
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
