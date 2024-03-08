<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'price',
        'description',
        'is_available'
    ];

    public function SaleProduct()
    {
        return $this->hasMany(SaleProduct::class, 'product_id', 'id');
    }
}
