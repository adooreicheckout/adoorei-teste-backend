<?php

namespace App\Http\Controllers;

use App\Domain\Product\Actions\CreateProductAction;
use App\Domain\Product\Actions\DeleteProductAction;
use App\Domain\Product\Actions\GetAllProductsAction;
use App\Domain\Product\Actions\UpdateProductAction;
use App\Domain\Product\DTO\CreateProductDTO;
use App\Domain\Product\DTO\UpdateProductDTO;
use App\Domain\Product\Entities\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $createProductAction;
    protected $updateProductAction;
    protected $deleteProductAction;
    protected $getAllProductsAction;

    public function __construct(
        CreateProductAction $createProductAction,
        UpdateProductAction $updateProductAction,
        DeleteProductAction $deleteProductAction,
        GetAllProductsAction $getAllProductsAction
    ) {
        $this->createProductAction = $createProductAction;
        $this->updateProductAction = $updateProductAction;
        $this->deleteProductAction = $deleteProductAction;
        $this->getAllProductsAction = $getAllProductsAction;
    }

    public function create(Request $request): JsonResponse
    {

        $createProductDTO = new CreateProductDTO(
            $request->input('name'),
            $request->input('price'),
            $request->input('description')
        );

        $product = $this->createProductAction->execute($createProductDTO);

        return response()->json(['product' => $product], 201);
    }

    public function update(Product $product, Request $request): JsonResponse
    {
        $updateProductDTO = new UpdateProductDTO(
            $request->input('name'),
            $request->input('price'),
            $request->input('description')
        );

        $validatedData = $updateProductDTO->validate();

        $this->updateProductAction->execute($product, $validatedData);

        return response()->json(['message' => 'Product updated successfully'], 200);
    }

    public function delete(Product $product): JsonResponse
    {
        $this->deleteProductAction->execute($product);

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    public function index(): JsonResponse
    {
        $products = $this->getAllProductsAction->execute();

        return response()->json(['products' => $products], 200);
    }
}
