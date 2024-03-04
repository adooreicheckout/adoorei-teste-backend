<?php

namespace App\Repositories\Sales;

use App\Models\Sales;
use App\Repositories\BaseRepository;
use App\Repositories\Sales\Contracts\SaleRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class SaleRepository extends BaseRepository implements SaleRepositoryContract
{
    /**
     * @var Sales $Smodel
     */
    protected $model;

    /**
     * @param Sales $sales
     */
    public function __construct(Sales $sales)
    {
        $this->model = $sales;
    }

    public function getSales(array $relations): Collection
    {
        return $this->model->with($relations)
            ->select('sale_id', 'amount', 'status')->get();
    }
}
