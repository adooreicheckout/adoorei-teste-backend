<?php

namespace Domain\UseCases;

use App\Exceptions\SaleAlreadyCanceledException;
use App\Models\Sale;
use Domain\Repositories\ProductsRepository;
use Domain\Repositories\SalesRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CancelSaleUseCase
{
    public function __construct(protected SalesRepository $salesRepository) {}

    public function execute($id)
    {
        $sale = $this->salesRepository->findById($id);

        if ($sale->status === Sale::STATUS_CANCELLED) {
            throw new SaleAlreadyCanceledException();
        }

        $saleUpdated = $this->salesRepository->update([
            'status' => Sale::STATUS_CANCELLED,
        ], $sale);

        return $sale;
    }
}
