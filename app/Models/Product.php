<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'price' => ['gt', 'gte', 'lt', 'lte', 'eq', 'in']
    ];
}
