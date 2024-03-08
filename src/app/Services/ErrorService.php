<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Throwable;

class ErrorService
{
    public static function checkInvalidUser(): void
    {
        if (empty(auth()->user())) {
            abort(
                response()->json(
                    [
                        'error' => 'Access Denied because User is invalid.'
                    ],
                    Response::HTTP_UNAUTHORIZED
                )
            );
        }
    }

    public static function expectationFailed(Throwable $exception): JsonResponse
    {
        return response()->json(
            [
                'error' => 'Operation failed.',
                'error_message' => $exception->getMessage(),
                'error_file' => $exception->getFile(),
                'error_line' => $exception->getLine()
            ],
            Response::HTTP_EXPECTATION_FAILED
        );
    }
}
