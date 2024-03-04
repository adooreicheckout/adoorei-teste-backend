<?php

namespace App\Http\Requests\Modules\Sale;

use App\Http\Requests\Generics\BaseRequest;
use Domain\Modules\Sale\Create\Collections\ProductSaleCollection;
use Domain\Modules\Sale\Create\Entities\ProductSaleEntity;
use Domain\Modules\Sale\Create\Entities\RequestEntity;

class CreateSaleRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'products' => 'required|array',
            'products.*.product_id' => "required|numeric|exists:product,id",
            'products.*.quantity' => "required|numeric|min:1"
        ];
    }

    public function toUseCaseRequest(): RequestEntity
    {
        $validated = $this->validated();
        $productSaleCollection = new ProductSaleCollection();
        foreach ($validated['products'] as $productSale) {
            $productSaleCollection->addProductSale(new ProductSaleEntity(
                productId: $productSale['product_id'],
                quantity: $productSale['quantity']
            ));
        }
        return new RequestEntity(
            $productSaleCollection
        );
    }
}
