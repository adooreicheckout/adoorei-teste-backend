<?php

namespace App\Services;

use Illuminate\Http\Request;

class RequestService
{
    public static function makeValidation(string $requestClass, Request $request): array
    {
        $formRequest = new $requestClass();

        $validation = validator(
            $request->all(),
            $formRequest->rules($request),
            $formRequest->messages()
        );

        $errors = [];
        foreach ($validation->errors()->getMessages() as $key => $array) {
            $errors[$key] = $array;
        }

        return $errors;
    }
}
