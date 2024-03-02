<?php

namespace App\Models;

use App\Enum\SaleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'sales_id'; //Segui o que estava no README do desafio, pois o padrão do nome seria no singular

    protected $fillable = [
        'amount',
        'status',
    ];

    protected $casts = [
        'status' => SaleStatus::class,
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'sale_products', 'sales_id', 'product_id')
            ->withPivot('amount')
            ->withTimestamps();
    }
}
