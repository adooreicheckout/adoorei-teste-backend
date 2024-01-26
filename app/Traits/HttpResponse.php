<?php

namespace App\Traits;

use App\Enums\Messages\Http\Response as MessageResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\MessageBag;

trait HttpResponse
{
    public function error(string|MessageResponse $message, string|int $status = Response::HTTP_BAD_REQUEST, array|MessageBag $errors = [], $content = [])
    {
        if ($message instanceof MessageResponse) {
            $message = $message->value;
        }

        return response()->json([
            'message' => $message,
            'status' => $status,
            'errors' => $errors,
            'content' => $content
        ], $status);
    }

    public function success(string|MessageResponse $message, int $status, array|JsonResource $content = [])
    {
        if ($message instanceof MessageResponse) {
            $message = $message->value;
        }

        $response = [
            'message' => $message,
            'status' => $status,
            'content' => $content
        ];

        return response()->json($response, $status);
    }
}
