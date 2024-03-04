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

    public function execute(array $data, int $id): Sale | SaleAlreadyCanceledException
    {
        $sale = $this->salesRepository->findByIdWithProducts($id);

        if ($sale->status === Sale::STATUS_CANCELED) {
            throw new SaleAlreadyCanceledException("Sale already canceled! You can't add new products to a canceled sale.");
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
            'status' => Sale::STATUS_COMPLETE,
        ], $sale);

        return $sale;
    }
}
