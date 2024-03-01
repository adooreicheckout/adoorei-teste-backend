<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount'
    ];

    public function saleproduct(): HasMany
    {
        return $this->hasMany(SaleProduct::class);
    }
}
