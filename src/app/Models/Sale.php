<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function saleProduct()
    {
        return $this->hasMany(SaleProduct::class, 'sales_id', 'id');
    }
}
