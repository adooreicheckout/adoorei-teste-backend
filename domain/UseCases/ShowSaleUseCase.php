<?php

namespace Domain\UseCases;

use App\Models\Sale;
use Domain\Repositories\SalesRepository;

class ShowSaleUseCase
{
    public function __construct(protected SalesRepository $salesRepository) {}

    public function execute(int $id): Sale
    {
        $sale = $this->salesRepository->findByIdWithProducts($id);

        return $sale;
    }
}
