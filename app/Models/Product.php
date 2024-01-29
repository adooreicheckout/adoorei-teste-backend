<?php

namespace App\Models;

use App\Models\Sale\Sale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'price',
        'description'
    ];

    public static $allowedOperatorsFields = [
        'name' => ['eq', 'in', 'lk'],
        'price' => ['gt', 'gte', 'lt', 'lte', 'eq', 'ne', 'in']
    ];
}
