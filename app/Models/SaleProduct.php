<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleProduct extends Model
{
    use HasFactory;

    protected $fillable =[
        'sale_id',
        'product_id',
        'name',
        'price',
        'quantity'
    ];

    public function productSale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }
}
