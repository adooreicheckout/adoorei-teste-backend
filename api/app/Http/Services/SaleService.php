<?php

namespace App\Http\Services;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;

class SaleService
{
    protected $sale;
    protected $saleProduct;
    protected $product;

    public function __construct(Sale $sale, SaleProduct $saleProduct, Product $product)
    {
        $this->sale = $sale;
        $this->saleProduct = $saleProduct;
        $this->product = $product;
    }

    public function createSale(array $saleData)
    {
        $sale = $this->sale::create(['amount' => 0]);
        $totalAmount = 0;
        $products = [];

        foreach ($saleData['products'] as $productData) {

            $product = $this->findOrCreateProduct($productData);
            $quantity = $productData['amount'];
            $totalAmount += $product->price * $quantity;

            $this->saleProduct::create([
                'sales_id' => $sale['id'],
                'product_id' => $product['id'],
                'quantity' => $quantity,
            ]);

            $products[] = [
                'product_id' => $product->id,
                'name' => $product['name'],
                'price' => $product['price'],
                'amount' => $quantity,
            ];
        }

        $sale->amount = $totalAmount;
        $sale->save();

        return [
            'sales_id' => $sale['id'],
            'amount' => $totalAmount,
            'products' => $products,
        ];
    }

    public function updateSale(int $saleId, array $saleData)
    {
        $sale = $this->sale::find($saleId);

        if (!$sale) {
            return response()->json(['message' => 'Sale not found'], 404);
        }
    
        $totalAmount = $sale->amount;
       
    
        foreach ($saleData['products'] as $productData) {
            $product = $this->findOrCreateProduct($productData);
    
            $quantity = $productData['amount'];
            $totalAmount += $product->price * $quantity;
    
            $this->saleProduct::create([
                'sales_id' => $sale['id'],
                'product_id' => $product['id'],
                'quantity' => $quantity,
            ]);

        }
    
        $sale->amount = $totalAmount;
        $sale->save();

        $sale = $this->sale->with('SaleProduct.product')->find($saleId);

        $formattedSale = [
            'sale_id' => $sale->id,
            'amount' => $sale->amount,
            'products' => $sale->SaleProduct->map(function ($saleProduct) {
                return [
                    'product_id' => $saleProduct->product->id,
                    'name' => $saleProduct->product->name,
                    'price' => $saleProduct->product->price,
                    'quantity' => $saleProduct->quantity,
                ];
            }),
        ];

        return response()->json($formattedSale);
    }

    protected function findOrCreateProduct(array $productData)
    {
        $product = $this->product::where('id', $productData['product_id'])
            ->orWhere('name', $productData['name'])
            ->first();
        return $product;
    }
}
