<?php

namespace App\Repositories;

use App\Contracts\Repositories\Sale as SaleContract;
use App\Enum\SaleStatus;
use App\Models\Sale;
use App\Models\SaleProduct;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;


class SaleRepository implements SaleContract
{
    public function modalQuery(): Builder
    {
        return Sale::query();
    }
    public function list(array $filters): Collection|Model|Paginator|null
    {
        $query = $this->modalQuery();
        $query->with(['salesProducts' => function ($query) {
            $query->with(['products' => function ($query) {
                $query->select('product_id', 'name', 'price');
            }]);
        }])->select('sales_id', 'amount');
        if (isset($filters['id'])) {
            return $query->where('sales.sales_id', $filters['id'])->first();
        }
        if (isset($filters['perpage'])) {
            return $query->simplePaginate($filters['perpage']);
        }
        return $query->get();
    }

    public function store(array $data): bool
    {
        try {
            DB::beginTransaction();

            $sale =  new Sale();
            $sale->amount = $data['total'];
            $sale->status = SaleStatus::completed()->value;
            $sale->save();

            foreach ($data['products'] as $product) {
                $saleProduct = new SaleProduct();
                $saleProduct->sales_id = $sale->sales_id;
                $saleProduct->fill($product);
                $saleProduct->save();
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return false;
        }

    }

    public function update(array $data): bool
    {
        try {
            DB::beginTransaction();

            $sale = Sale::query()->find($data['id']);

            $sale->amount = $data['total'];
            $sale->status = SaleStatus::completed()->value;
            $sale->save();

            foreach ($data['products'] as $product) {
                $saleProduct = SaleProduct::query()
                    ->where('sales_id', $sale->sales_id)
                    ->where('product_id', $product['product_id'])->first();
                $saleProduct->fill($product);
                $saleProduct->save();
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return false;
        }
    }

    public function destroy(Model $model): bool
    {
        unset($model->products);
        $model->status = SaleStatus::cancelled()->value;
        $model->deleted_at = now();
        $model->save();
        return true;
    }

    public function getById(int $id): Model|null
    {
        return $this->list(['id' => $id]);
    }
}
