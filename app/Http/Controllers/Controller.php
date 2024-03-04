<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function handleUnexpectedError(array $additionalData = []): \Illuminate\Http\JsonResponse
    {
        $dataToLog = array_merge(
            [
                'message' => 'Ocorreu um erro inesperado no servidor. Por favor, tente novamente mais tarde.',
            ],
            $additionalData
        );

        return response()->json($dataToLog, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
