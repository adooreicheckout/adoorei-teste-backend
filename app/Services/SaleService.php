<?php

namespace App\Services;

use App\Http\Requests\SaleCreateRequest;
use App\Interfaces\Repositories\SaleProductRepositoryInterface;
use App\Interfaces\Repositories\SaleRepositoryInterface;
use App\Models\Product;
use App\Models\Sale;
use Exception;
use Illuminate\Support\Facades\DB;

class SaleService
{
    public function __construct(
        private SaleRepositoryInterface $saleRepositoryInterface,
        private SaleProductRepositoryInterface $saleProductRepositoryInterface
    ) {
    }

    public function create(SaleCreateRequest $request)
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

    public function list()
    {
        $list = $this->saleRepositoryInterface->getAll();

        return $list;
    }
}
