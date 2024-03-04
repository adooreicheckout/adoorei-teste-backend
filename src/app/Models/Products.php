<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Products extends Model
{
    use HasFactory;

    public $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'price',
        'description'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->product_id = (string) Str::uuid();
        });
    }
}
