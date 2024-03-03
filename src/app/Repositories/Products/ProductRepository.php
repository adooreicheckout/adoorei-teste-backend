<?php

namespace App\Repositories\Products;

use App\Models\Products;
use App\Repositories\BaseRepository;
use App\Repositories\Products\Contracts\ProductRepositoryContract;

class ProductRepository extends BaseRepository implements ProductRepositoryContract
{
    /**
     * @var Products $consulate
     */
    protected $model;

    /**
     * @param Products $products
     */
    public function __construct(Products $products)
    {
        $this->model = $products;
    }
}
