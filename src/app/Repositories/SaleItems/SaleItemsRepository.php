<?php

namespace App\Repositories\SaleItems;

use App\Models\SaleItems;
use App\Repositories\BaseRepository;
use App\Repositories\SaleItems\Contracts\SaleItemsRepositoryContract;

class SaleItemsRepository extends BaseRepository implements SaleItemsRepositoryContract
{
    /**
     * @var SaleItems $salesItems
     */
    protected $model;

    /**
     * @param SaleItems $salesItems
     */
    public function __construct(SaleItems $salesItems)
    {
        $this->model = $salesItems;
    }
}
