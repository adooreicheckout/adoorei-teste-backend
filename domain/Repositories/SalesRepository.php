<?php

namespace Domain\Repositories;

interface SalesRepository
{
    public function create($data);
    public function findById($saleId);
    public function findByIdWithProducts($saleId);
    public function findByStatus($status);
    public function update($data, $saleId);
    public function createProductsBySale($data, $saleId);
}
