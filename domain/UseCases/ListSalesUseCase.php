<?php

namespace Domain\UseCases;

use Domain\Repositories\SalesRepository;
use Illuminate\Database\Eloquent\Collection;

class ListSalesUseCase
{
    public function __construct(protected SalesRepository $salesRepository) {}

    public function execute(): Collection
    {
        $sales = $this->salesRepository->findAll();

        return $sales;
    }
}
