<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItems extends Model
{
    protected $table = 'sale_items';

    protected $fillable = [
        'sale_id',
        'product_id'
    ];

    public function sale() {
        return $this->belongsTo('App\Models\Sales');
    }

    public function product() {
        return $this->belongsTo('App\Models\Products', 'product_id', 'product_id');
    }
}
