<?php

namespace Domain\Repositories;

interface ProductsRepository
{
    public function findAll();
    public function findById($id);
}
