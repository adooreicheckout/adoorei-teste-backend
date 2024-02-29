<?php

namespace App\Domain\Product\Actions;

use App\Domain\Product\Repositories\ProductRepository;
use App\Domain\Product\Validators\ProductValidator;
use App\Domain\Product\DTO\CreateProductDTO;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class CreateProductAction
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(CreateProductDTO $createProductDTO)
    {

        $validatedData = $createProductDTO->validate();
        $validator = ProductValidator::validateCreate($validatedData);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'data'      => $validator->errors()
            ],400));
        }


        return $this->productRepository->create($validatedData);
    }
}
