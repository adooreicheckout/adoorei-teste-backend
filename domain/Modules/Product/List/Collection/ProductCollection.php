<?php

namespace Domain\Modules\Product\List\Collection;

use Domain\Generics\Collection\Collection;
use Domain\Modules\Product\List\Entities\Product;

class ProductCollection extends Collection
{
    public function addProduct(Product $product): self
    {
        parent::add($product);
        return $this;
    }


    public function toArray(): array
    {
        $products = [];
        foreach ($this->data as $data) {
            $products[] = [
                'id' => $data->id,
                'name' => $data->name,
                'description' => $data->description,
                'price' => $data->price
            ];
        }
        return $products;
    }
}
