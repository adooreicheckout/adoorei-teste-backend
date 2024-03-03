<?php

namespace Domain\UseCases;

use App\Models\Sale;
use Domain\Repositories\ProductsRepository;
use Domain\Repositories\SalesRepository;
use Exception;

class ShowCompletedSalesUseCase
{
    public function __construct(protected SalesRepository $salesRepository) {}

    public function execute()
    {
        $sales = $this->salesRepository->findByStatus(Sale::STATUS_COMPLETED);

        return $sales;
    }
}
