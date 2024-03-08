<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vendas;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class VendasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['sales'])]
    public function index()
    {
        $vendas = Vendas::all()->load('products');

        $vendas = $vendas->map(function ($venda) {
            return [
                'sales_id' => $venda->id,
                'amount' => $venda->amount,
                'status' => $venda->status,
                'products' => $venda->products->map(function ($prod) {
                    return [
                        'product_id' => $prod->id,
                        'nome' => $prod->name,
                        'price' => $prod->pivot->price,
                        'amount' => $prod->pivot->amount,
                    ];
                })
            ];
        });

        return response()->json($vendas, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OpenApi\Operation(tags: ['sales'])]
    public function store(Request $request)
    {
        $dados = $request->input();
        $dados['amount'] = 0;

        $produtos = collect($dados['products'])->map(function ($prod) use (&$dados) {
            //Trada os dados eviados pelo front para um formato float valido
            $prod['price'] = (float) str_replace(',', '.', $prod['price']);
            $dados['amount'] += $prod['amount'] * $prod['price'];

            return $prod;
        });

        DB::transaction(function () use ($dados, $produtos) {
            $venda = Vendas::create($dados);
            $venda->products()->attach($produtos);
        });

        return response()->json(['msg' => 'criado com sucesso'], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(tags: ['sales'])]
    public function show(Vendas $venda)
    {

        $venda->load('products');

        $venda = [
            'sales_id' => $venda->id,
            'amount' => $venda->amount,
            'status' => $venda->status,
            'products' => $venda->products->map(function ($prod) {
                return [
                    'product_id' => $prod->id,
                    'nome' => $prod->name,
                    'price' => $prod->pivot->price,
                    'amount' => $prod->pivot->amount,
                ];
            })
        ];

        return response()->json($venda, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(tags: ['sales'])]
    public function update(Request $request, Vendas $venda)
    {

        $dados = $request->input();
        $produtos = $dados['products'];
        $dados['amount'] = 0;

        $produtos = collect($dados['products'])->map(function ($prod) use (&$dados) {
            //Trada os dados eviados pelo front para um formato float valido
            $prod['amount'] = str_replace(',', '.', $prod['amount']);
            $dados['amount'] += $prod['amount'] * $prod['price'];

            return $prod;
        });

        DB::transaction(function () use ($venda, $dados, $produtos) {
            $venda->update($dados);
            $venda->products()->detach();
            $venda->products()->attach($produtos);
        });

        return response()->json(['msg' => 'alterado com sucesso'], Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(tags: ['sales'])]
    public function destroy(Vendas $venda)
    {
        DB::transaction(function () use ($venda) {
            // $venda->products()->detach();
            $venda->delete();
        });

        return response()->json(['msg' => 'deletado com sucesso'], Response::HTTP_NO_CONTENT);
    }

    /**
     * cancel the specified resource from storage.
     */
    #[OpenApi\Operation(tags: ['sales'], method: 'GET')]
    public function cancelSale(Vendas $venda)
    {
        if ($venda->status) {
            $venda->update(['status' => 0]);
        } else {
            return response()->json(['msg' => "Venda {$venda->id} já se encontra cancelada"], Response::HTTP_OK);
        }

        return response()->json(['msg' => "Venda {$venda->id} cancelada!"], Response::HTTP_OK);
    }
}
