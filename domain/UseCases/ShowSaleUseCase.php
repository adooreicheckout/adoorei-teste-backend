<?php

namespace Domain\UseCases;

use App\Models\Sale;
use Domain\Repositories\ProductsRepository;
use Domain\Repositories\SalesRepository;
use Exception;

class ShowSaleUseCase
{
    public function __construct(protected SalesRepository $salesRepository) {}

    public function execute($id)
    {
        $sale = $this->salesRepository->findByIdWithProducts($id);

        return $sale;
    }
}
