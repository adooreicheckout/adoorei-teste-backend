<?php

namespace App\Services\Sales\Contracts;

interface SaleServiceContract
{
    public function get(): array;

    public function create(array $params): array;

    public function getById(string $saleId): array;

    public function cancelSale(string $saleId): ?bool;

    public function addProduct(string $saleId, array $params): array;
}
