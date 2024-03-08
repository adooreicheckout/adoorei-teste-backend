<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SaleRequest;
use App\Services\SaleService;

/**
 * @OA\Get(
 *     path="/api/sales",
 *     tags={"Sales"},
 *     summary="Return a List of Active Sales",
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
 *     @OA\Response(
 *         response=200,
 *         description="OK - Query performed successfully",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="sales_id",
 *                 type="integer",
 *                 example="1"
 *             ),
 *             @OA\Property(
 *                 property="amount",
 *                 type="number",
 *                 example="8200.14"
 *             ),
 *             @OA\Property(
 *                 property="products",
 *                 type="array",
 *                 @OA\Items(
 *                     @OA\Property(
 *                         property="product_id",
 *                         type="integer",
 *                         example="5"
 *                     ),
 *                     @OA\Property(
 *                         property="name",
 *                         type="string",
 *                         example="Celular"
 *                     ),
 *                     @OA\Property(
 *                         property="price",
 *                         type="number",
 *                         example="4100.07"
 *                     ),
 *                     @OA\Property(
 *                         property="amount",
 *                         type="integer",
 *                         example="2"
 *                     ),
 *                 )
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
 * ),
 * @OA\Post(
 *     path="/api/sales",
 *     tags={"Sales"},
 *     summary="Create a New Sale",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 required={"is_active", "products"},
 *                 @OA\Property(
 *                     property="is_active",
 *                     type="integer",
 *                     description="Indicates if the request is active"
 *                 ),
 *                 @OA\Property(
 *                     property="products",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(
 *                             property="product_id",
 *                             type="integer",
 *                             description="Product Id"
 *                         ),
 *                         @OA\Property(
 *                             property="amount",
 *                             type="integer",
 *                             description="Amount"
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created - New Record",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="id",
 *                 type="integer",
 *                 example="1"
 *             ),
 *             @OA\Property(
 *                 property="is_active",
 *                 type="boolean",
 *                 example="true"
 *             ),
 *             @OA\Property(
 *                 property="created_at",
 *                 type="string",
 *                 example="2024-03-07T19:18:17.000000Z"
 *             ),
 *             @OA\Property(
 *                 property="updated_at",
 *                 type="string",
 *                 example="2024-03-07T19:18:17.000000Z"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad Request - Invalid Request Data",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="field",
 *                 type="string",
 *                 example="Request Validation Message"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=417,
 *         description="Expectation Failed - When an unexpected error occurs",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="error",
 *                 type="string",
 *                 example="Record Create failed."
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
 * ),
 * @OA\Get(
 *     path="/api/sales/{id}",
 *     tags={"Sales"},
 *     summary="Return a Sale by a specific ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK - Query performed successfully",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="sales_id",
 *                 type="integer",
 *                 example="1"
 *             ),
 *             @OA\Property(
 *                 property="amount",
 *                 type="number",
 *                 example="8200.14"
 *             ),
 *             @OA\Property(
 *                 property="products",
 *                 type="array",
 *                 @OA\Items(
 *                     @OA\Property(
 *                         property="product_id",
 *                         type="integer",
 *                         example="5"
 *                     ),
 *                     @OA\Property(
 *                         property="name",
 *                         type="string",
 *                         example="Celular"
 *                     ),
 *                     @OA\Property(
 *                         property="price",
 *                         type="number",
 *                         example="4100.07"
 *                     ),
 *                     @OA\Property(
 *                         property="amount",
 *                         type="integer",
 *                         example="2"
 *                     ),
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found - When ID doesn't exist",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="error",
 *                 type="string",
 *                 example="Content not found."
 *             )
 *         )
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
 * ),
 * @OA\Put(
 *     path="/api/sales/{id}",
 *     tags={"Sales"},
 *     summary="Add Product in a Sale by a specific ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 required={"products"},
 *                 @OA\Property(
 *                     property="products",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(
 *                             property="product_id",
 *                             type="integer",
 *                             description="Product Id"
 *                         ),
 *                         @OA\Property(
 *                             property="amount",
 *                             type="integer",
 *                             description="Amount"
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created - New Record",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="id",
 *                 type="integer",
 *                 example="1"
 *             ),
 *             @OA\Property(
 *                 property="is_active",
 *                 type="boolean",
 *                 example="true"
 *             ),
 *             @OA\Property(
 *                 property="created_at",
 *                 type="string",
 *                 example="2024-03-07T19:18:17.000000Z"
 *             ),
 *             @OA\Property(
 *                 property="updated_at",
 *                 type="string",
 *                 example="2024-03-07T19:18:17.000000Z"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad Request - Invalid Request Data",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="field",
 *                 type="string",
 *                 example="Request Validation Message"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=417,
 *         description="Expectation Failed - When an unexpected error occurs",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="error",
 *                 type="string",
 *                 example="Record Create failed."
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
 * ),
 * @OA\Patch(
 *     path="/api/sales/{id}",
 *     tags={"Sales"},
 *     summary="Cancel a Sale by a specific ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK - Record Deleted",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="id",
 *                 type="integer",
 *                 example="1"
 *             ),
 *             @OA\Property(
 *                 property="is_active",
 *                 type="boolean",
 *                 example="true"
 *             ),
 *             @OA\Property(
 *                 property="created_at",
 *                 type="string",
 *                 example="2024-03-07T19:18:17.000000Z"
 *             ),
 *             @OA\Property(
 *                 property="updated_at",
 *                 type="string",
 *                 example="2024-03-07T19:18:17.000000Z"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found - When ID doesn't exist",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="error",
 *                 type="string",
 *                 example="Content not found."
 *             )
 *         )
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
class SalesController extends BaseController
{
    public function __construct()
    {
        $this->serviceClass = SaleService::class;
        $this->requestClass = SaleRequest::class;
    }
}
