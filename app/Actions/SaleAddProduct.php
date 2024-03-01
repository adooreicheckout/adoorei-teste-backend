<?php

namespace App\Actions;

use App\Models\Sale;
use App\Traits\CalculateSaleAmount;
use App\Traits\SaleProductsInsert;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SaleAddProduct extends BaseAction
{
    use CalculateSaleAmount, SaleProductsInsert;
    protected function rules(): array
    {
        return [
            'products' => ['required', 'array', 'min:1'],
            'products.*.id' => ['required', 'integer', 'exists:cellphones,id'],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
        ];
    }

    public function execute($id, Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = Validator::make($request->all(), $this->rules());

            $products = $data->validate();

            $sale = $this->calculate($products);

            $this->addProductsAndSaleAmountUpdate($id, $sale);

            if ($data->fails()) {
                throw new ValidationException($data);
            }
        } catch (ValidationException|Exception $e) {
            return response()->json($e->errors(), 422);
        }

        return response()->json(['message' =>'success'], 200);
    }

    /**
     * @throws Exception
     */
    public function addProductsAndSaleAmountUpdate($id, $sale): void
    {
        DB::beginTransaction();

        try {

            $originalSale = Sale::findOrFail($id);
            $originalSale->update([
                'amount' => $sale['saleAmount'] + $originalSale->amount
            ]);

            $this->saleProductsInsert($id, $sale);

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            throw  $e;
        }

    }
}
