<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['products'])]
    public function index()
    {
        return response()->json(Produtos::all(), Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->input();

        DB::transaction(function () use ($dados) {
            Produtos::create($dados);
        });

        return response()->json(['msg' => 'criado com sucesso'], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produtos $produto)
    {
        return response()->json($produto, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produtos $produto)
    {
        $dados = $request->input();

        DB::transaction(function () use ($produto, $dados) {
            $produto->update($dados);
        });

        return response()->json(['msg' => 'alterado com sucesso'], Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produtos $produto)
    {
        DB::transaction(function () use ($produto) {
            $produto->delete();
        });

        return response()->json(['msg' => 'deletado com sucesso'], Response::HTTP_NO_CONTENT);
    }
}
