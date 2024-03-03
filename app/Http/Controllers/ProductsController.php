<?php

namespace App\Http\Controllers;

use App\Database\Repositories\Eloquent\EloquentProductsRepository;
use App\Http\Resources\ProductsResource;
use App\Models\Product;
use Domain\UseCases\ListProductsUseCase;
use Exception;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $productsRepository = new EloquentProductsRepository();
            $listProductsUseCase = new ListProductsUseCase($productsRepository);

            $productsListed = $listProductsUseCase->execute();
            $produtsApiCollection = ProductsResource::collection($productsListed);

            return response()->json($produtsApiCollection);
        } catch (Exception $e) {
            return $this->handleUnexpectedError();
        }
    }
}
