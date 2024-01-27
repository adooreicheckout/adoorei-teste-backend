<?php

namespace App\Models\Sale;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleProduct extends Model
{
    use HasFactory;
    protected $table = 'sale_products';
    protected $fillable = [
        'sale_id',
        'product_id',
        'amount'
    ];

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function sale() {
        return $this->belongsTo(Sale::class, 'sale_id');
    }
}
