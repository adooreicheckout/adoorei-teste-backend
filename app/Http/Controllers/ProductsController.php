<?php

namespace App\Http\Controllers;

use App\Database\Repositories\ProductsRepository;
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
            $productsRepository = new ProductsRepository();
            $listProductsUseCase = new ListProductsUseCase($productsRepository);
            $productsListed = $listProductsUseCase->execute();

            return response()->json($productsListed);
        } catch (Exception $e) {
            return $this->handleUnexpectedError();
        }
    }
}
