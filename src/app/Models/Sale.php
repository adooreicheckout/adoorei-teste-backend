<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

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
