<?php

namespace App\Domain\Orders\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'order_id';
    public $incrementing = false;

    protected $keyType = 'string';
    protected $fillable = [
        'order_id', 'amount', 'status'
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
