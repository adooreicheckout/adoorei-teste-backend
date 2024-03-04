<?php

namespace App\Repositories\Products;

use App\Models\Products;
use App\Repositories\BaseRepository;
use App\Repositories\Products\Contracts\ProductRepositoryContract;
use Illuminate\Database\Eloquent\Model;

class ProductRepository extends BaseRepository implements ProductRepositoryContract
{
    /**
     * @var Products $model
     */
    protected $model;

    /**
     * @param Products $products
     */
    public function __construct(Products $products)
    {
        $this->model = $products;
    }

    /**
     * @param string $id
     * @return Model
     */
    public function getById(string $id): Object
    {
        return $this->model->where('product_id', $id)->first();
    }
}
