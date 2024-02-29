<?php

namespace App\Domain\Product\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'product_id';
    public $incrementing = false;

    protected $keyType = 'string';
    protected $fillable = [
        'product_id', 'name', 'price', 'description'
    ];
    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
