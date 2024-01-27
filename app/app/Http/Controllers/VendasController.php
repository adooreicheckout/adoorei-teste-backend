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

        $vendas->products->map(function($a){
            dump($a);
        });

        dd("Aqui");
        
        return response()->json($vendas, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->input();
        $dados['amount'] = 0;

        $produtos = collect($dados['products'])->map(function($prod) use(&$dados){
            //Trada os dados eviados pelo front para um formato float valido
            $prod['price'] = (float) str_replace('.', '', $prod['price']);

            $dados['amount'] += $prod['amount'] * $prod['price'];

            return $prod;
        });



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
        $dados['amount'] = 0;

        $produtos = collect($dados['products'])->map(function($prod) use(&$dados){
            //Trada os dados eviados pelo front para um formato float valido
            $prod['amount'] = str_replace('.', '', $prod['amount']);
            $dados['amount'] += $prod['amount'] * $prod['price'];

            return $prod;
        });

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

    public function cancelSale(VendasModel $venda){
        if($venda->status){
            $venda->update(['status' => 0]);
        }else{
            return response()->json(['msg' => "Venda {$venda->id} já se encontra cancelada"], Response::HTTP_OK);
        }

        return response()->json(['msg' => "Venda {$venda->id} cancelada!"], Response::HTTP_OK);
    }
}
