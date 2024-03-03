<?php

namespace App\Services;

use App\Contracts\Services\Sale as SaleContract;
use App\Repositories\ProductRepository;
use App\Repositories\SaleRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class SaleService implements SaleContract
{

    private SaleRepository $saleRepository;
    private ProductRepository $productRepository;

    public function __construct(SaleRepository $saleRepository, ProductRepository $productRepository)
    {
        $this->saleRepository = $saleRepository;
        $this->productRepository = $productRepository;
    }

    public function list(array $filters = []): Collection|Model|LengthAwarePaginator|null
    {
        $products = [];
        $result = $this->saleRepository->list($filters);

        if (empty($result)) {
            return null;
        }

        if ($result instanceof Model) {
            foreach ($result->salesProducts as $r) {
                $r->products->amount = $r->amount;
                $products[] = $r->products;
                unset($r->products);
            }
            unset($result->salesProducts);
            $result->products = $products;
            return $result;
        }

        foreach ($result as $row) {
            $products = [];
            foreach ($row->salesProducts as $r) {
                $r->products->amount = $r->amount;
                $products[] = $r->products;
                unset($r->products);
            }
            unset($row->salesProducts);
            $row->products = $products;
        }
        return $result;
    }

    public function store(array $data): bool
    {
        $total = 0;
        foreach ($data['products'] as $row) {
            $product = $this->productRepository->getById($row['product_id']);
            $total += $product->price * floatval($row['amount']);
        }
        $data['total'] = floatval($total);
        return $this->saleRepository->store($data);
    }

    public function update(Model $model): bool
    {
        // TODO: Implement update() method.
    }

    public function destroy(int $id): bool
    {
        $sales = $this->getById($id);
        if (empty($sales)) {
            return false;
        }
        return $this->saleRepository->destroy($sales);
    }

    public function getById(int $id): Model|null
    {
        return $this->list(['id' => $id]);
    }
}
