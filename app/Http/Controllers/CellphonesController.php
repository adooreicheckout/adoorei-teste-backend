<?php

namespace App\Http\Controllers;

use App\Models\Cellphone;

class CellphonesController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $cellphones = Cellphone::all();

        $cellphones = $cellphones->map(function ($cellphone) {
            unset($cellphone['created_at']);
            unset($cellphone['updated_at']);
            return $cellphone;
        });

        return response()->json($cellphones);
    }
}
