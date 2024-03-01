<?php
 namespace App\Traits;

 use App\Models\Cellphone;

 trait CalculateSaleAmount {
     public function calculate($products): array
     {
         $quantityMap = array_reduce($products['products'], function ($carry, $product) {
             $carry[$product['id']] = $product['quantity'];
             return $carry;
         }, []);

         $cellphoneIds = array_column($products['products'], 'id');

         $saleProducts = Cellphone::whereIn('id', $cellphoneIds)->get();

         $saleAmount = 0;
         foreach ($saleProducts as $saleProduct) {
             $quantity = $quantityMap[$saleProduct->id];
             $saleAmount += $quantity * $saleProduct->price;
         }

         return [
             'saleProducts' => $saleProducts,
             'saleAmount' => $saleAmount,
             'quantity' => $quantityMap
         ];

     }
 }
