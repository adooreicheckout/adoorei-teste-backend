<?php

namespace Domain\UseCases;

use App\Exceptions\SaleAlreadyCanceledException;
use App\Models\Sale;
use Domain\Repositories\SalesRepository;

class CancelSaleUseCase
{
    public function __construct(protected SalesRepository $salesRepository) {}

    public function execute(int $id): Sale | SaleAlreadyCanceledException
    {
        $sale = $this->salesRepository->findById($id);

        if ($sale->status === Sale::STATUS_CANCELED) {
            throw new SaleAlreadyCanceledException();
        }

        $saleUpdated = $this->salesRepository->update([
            'status' => Sale::STATUS_CANCELED,
        ], $sale);

        return $sale;
    }
}
