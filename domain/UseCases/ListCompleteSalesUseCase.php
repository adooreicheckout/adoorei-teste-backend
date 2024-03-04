<?php

namespace Domain\UseCases;

use App\Models\Sale;
use Domain\Repositories\SalesRepository;
use Illuminate\Database\Eloquent\Collection;

class ListCompleteSalesUseCase
{
    public function __construct(protected SalesRepository $salesRepository) {}

    public function execute(): Collection
    {
        $sales = $this->salesRepository->findByStatus(Sale::STATUS_COMPLETE);

        return $sales;
    }
}
