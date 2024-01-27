<?php

namespace App\Http\Controllers;

use App\Models\VendasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class VendasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendas = VendasModel::all()->load('products');
        
        return response()->json($vendas, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->input();
        $produtos = $dados['products'];

        DB::transaction(function() use($dados, $produtos){
            $venda = VendasModel::create($dados);
            $venda->products()->attach($produtos);
        });

        return response()->json(['msg' => 'criado com sucesso'], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(VendasModel $venda)
    {
        return response()->json($venda->load('products'), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VendasModel $venda)
    {
        
        $dados = $request->input();
        $produtos = $dados['products'];

        $dados['amount'] = array_sum(array_map(function($prod){return $prod['amount'] * $prod['price'];}, $produtos));

        DB::transaction(function() use($venda, $dados, $produtos){
            $venda->update($dados);
            $venda->products()->detach();
            $venda->products()->attach($produtos);
        });

        return response()->json(['msg' => 'alterado com sucesso'], Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VendasModel $venda)
    {
        DB::transaction(function() use($venda){
            // $venda->products()->detach();
            $venda->delete();
        });

        return response()->json(['msg' => 'deletado com sucesso'], Response::HTTP_NO_CONTENT);
    }
}
