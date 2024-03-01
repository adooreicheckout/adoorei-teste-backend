<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sales';

    protected $primaryKey = 'sales_id';

    protected $fillable = [
        'sales_id',
        'amount', //Essa coluna parece representar o valor total da venda, porém o nome na documentação está como quantidade (Amount), segui a documentação
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $with = ['products'];

    public static $saleProducts;

    public static function boot()
    {
        parent::boot();

        static::creating(function (Sale $sale) {
            $sale->amount = $sale->calculateProductsTotalPrice(
                static::$saleProducts
            );
        });

        static::updating(function (Sale $sale) {
            $newAmount = $sale->calculateProductsTotalPrice(
                $sale->products->toArray()
            );

            if ($sale->amount != $newAmount) {
                $sale->amount = $newAmount;
                $sale->save();
            }
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(SaleProduct::class, 'sale_id', 'sales_id');
    }

    protected function calculateProductsTotalPrice(array $products): float
    {
        $price = 0;

        foreach ($products as $saleProduct) {
            $product = Product::find($saleProduct['product_id']);

            $price += $saleProduct['amount'] * $product->price;
        }

        return $price;
    }
}
