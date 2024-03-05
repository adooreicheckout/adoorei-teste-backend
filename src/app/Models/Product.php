<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'price',
        'description',
    ];

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'sale_products', 'product_id', 'sales_id')
            ->withPivot('amount')
            ->withTimestamps();
    }
}
