<?php

namespace App\Models\Sale;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $fillable = [
        'amount',
        'sale_status_id'
    ];

    public static $allowedOperatorsFields = [
        'sale_status_id' => ['eq', 'in'],
        'amount' => ['gt', 'gte', 'lt', 'lte', 'eq', 'in', 'ne']
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'sale_products', 'sale_id', 'product_id')->withTimestamps()->withPivot('amount');
    }
}
