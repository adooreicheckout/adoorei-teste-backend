<?php

namespace App\Models\Sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'amount' => ['gt', 'gte', 'lt', 'lte', 'eq', 'in']
    ];
}
