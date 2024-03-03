<?php

namespace Domain\Repositories;

interface SalesRepository
{
    public function create($data);
    public function update($data, $saleId);
    public function updateSaleStatusById($status, $saleId);
    public function createProductsBySale($data, $saleId);
}
