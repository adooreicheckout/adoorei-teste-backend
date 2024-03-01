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

class SaleCreateAction extends BaseAction
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

    public function execute(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = Validator::make($request->all(), $this->rules());

            $products = $data->validate();

            $sale = $this->calculate($products);

            $createSale = $this->createSale($sale);

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
    public function createSale($sale)
    {
        DB::beginTransaction();

        try {

            $createSale = Sale::create([
                'amount' => $sale['saleAmount']
            ]);

            $saleId = $createSale->id;

            $this->saleProductsInsert($saleId, $sale);

            DB::commit();

            return $createSale;

        } catch (Exception $e) {
            DB::rollBack();
            throw  $e;
        }

    }
}
