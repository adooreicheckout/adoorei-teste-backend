<?php

namespace App\Http\Controllers;

use App\Models\ProdutosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(ProdutosModel::all(), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->input();

        DB::transaction(function() use($dados){
            ProdutosModel::create($dados);
        });

        return response()->json(['msg' => 'criado com sucesso'], Response::HTTP_CREATED);


    }

    /**
     * Display the specified resource.
     */
    public function show(ProdutosModel $produto)
    {
        return response()->json($produto, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProdutosModel $produto)
    {
        $dados = $request->input();

        DB::transaction(function() use($produto, $dados){
            $produto->update($dados);
        });

        return response()->json(['msg' => 'alterado com sucesso'], Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProdutosModel $produto)
    {
        DB::transaction(function() use($produto){
            $produto->delete();
        });

        return response()->json(['msg' => 'deletado com sucesso'], Response::HTTP_NO_CONTENT);
    }
}
