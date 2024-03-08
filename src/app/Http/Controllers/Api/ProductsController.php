<?php

namespace App\Http\Controllers\Api;

use App\Services\ProductService;

/**
 * @OA\Get(
 *     path="/api/products",
 *     tags={"Products"},
 *     summary="Return a List of Products",
 *     @OA\Parameter(
 *         name="limit",
 *         in="query",
 *         required=false,
 *         description="Limit",
 *         @OA\Schema(type="number")
 *     ),
 *     @OA\Parameter(
 *         name="page",
 *         in="query",
 *         required=false,
 *         description="Page",
 *         @OA\Schema(type="number")
 *     ),
 *     @OA\Parameter(
 *         name="is_available",
 *         in="query",
 *         required=false,
 *         description="Is Available",
 *         @OA\Schema(type="bool")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK - Query performed successfully",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="name",
 *                 type="string",
 *                 example="Celular"
 *             ),
 *             @OA\Property(
 *                 property="price",
 *                 type="number",
 *                 example="1800.76"
 *             ),
 *             @OA\Property(
 *                 property="description",
 *                 type="string",
 *                 example="Lorenzo Ipsulum"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="No Content - When data doesn't exist"
 *     ),
 *     @OA\Response(
 *         response=417,
 *         description="Expectation Failed - When an unexpected error occurs",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="error",
 *                 type="string",
 *                 example="Operation failed."
 *             ),
 *             @OA\Property(
 *                 property="error_message",
 *                 type="string",
 *                 example="Error Message."
 *             ),
 *             @OA\Property(
 *                 property="error_file",
 *                 type="string",
 *                 example="Error File."
 *             ),
 *             @OA\Property(
 *                 property="error_line",
 *                 type="string",
 *                 example="Error Line."
 *             )
 *         )
 *     )
 * )
 */
class ProductsController extends BaseController
{
    public function __construct()
    {
        $this->serviceClass = ProductService::class;
    }
}
