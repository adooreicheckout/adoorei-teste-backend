<?php

namespace App\Http\Controllers;

use App\Database\Repositories\Eloquent\EloquentProductsRepository;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Domain\UseCases\ListProductsUseCase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $productsRepository = new EloquentProductsRepository();
            $listProductsUseCase = new ListProductsUseCase($productsRepository);

            $productsListed = $listProductsUseCase->execute();
            $productsResource = ProductResource::collection($productsListed);

            return response()->json($productsResource);
        } catch (Exception $e) {
            return $this->handleUnexpectedError();
        }
    }
}
