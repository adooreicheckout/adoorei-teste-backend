<?php

namespace App\Services;

use App\Http\Requests\SaleCancelRequest;
use App\Http\Requests\SaleCreateRequest;
use App\Http\Requests\SaleGetRequest;
use App\Http\Requests\SaleUpdateRequest;
use App\Interfaces\Repositories\SaleProductRepositoryInterface;
use App\Interfaces\Repositories\SaleRepositoryInterface;
use App\Models\Product;
use App\Models\Sale;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SaleService
{
    public function __construct(
        private SaleRepositoryInterface $saleRepositoryInterface,
        private SaleProductRepositoryInterface $saleProductRepositoryInterface
    ) {
    }

    public function create(SaleCreateRequest $request): Sale
    {
        try {
            DB::beginTransaction();

            $salesData = $request->all();
            Sale::$saleProducts = $salesData['products'];

            $created = $this->saleRepositoryInterface->create($salesData);

            foreach (Sale::$saleProducts as $saleProduct) {
                $product = Product::find($saleProduct['product_id']);

                $saleProductData = [
                    'sale_id' => $created->sales_id,
                    'product_id' => $saleProduct['product_id'],
                    'nome' => $product->name,
                    'price' => $product->price,
                    'amount' => $saleProduct['amount']
                ];

                $this->saleProductRepositoryInterface->create($saleProductData);
            }

            DB::commit();

            return $created->fresh();
        } catch (Exception $ve) {
            DB::rollBack();
            throw $ve;
        }
    }

    public function getById(SaleGetRequest $request): Sale
    {
        $sale = $this->saleRepositoryInterface->getById($request->sales_id);

        return $sale;
    }

    public function list(): Collection
    {
        $list = $this->saleRepositoryInterface->getAll();

        return $list;
    }

    public function cancel(SaleCancelRequest $request): bool
    {
        $cancel = $this->saleRepositoryInterface->delete($request->sales_id);

        return $cancel;
    }

    public function update(SaleUpdateRequest $request): Sale
    {
        try {
            DB::beginTransaction();

            foreach ($request->products as $saleProduct) {
                $product = Product::find($saleProduct['product_id']);

                $criteria = [
                    'sale_id' => $request->sales_id,
                    'product_id' => $saleProduct['product_id']
                ];

                $saleProductData = [
                    'nome' => $product->name,
                    'price' => $product->price,
                    'amount' => $saleProduct['amount']
                ];

                $this->saleProductRepositoryInterface->updateOrCreate($criteria, $saleProductData);
            }

            $sale = $this->saleRepositoryInterface->update(
                $request->sales_id,
                ['amount' => 0]
            );

            DB::commit();

            return $sale;
        } catch (Exception $ve) {
            DB::rollBack();
            throw $ve;
        }
    }
}
