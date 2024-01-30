<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $primaryKey = 'id';

    protected $fillable = ['sales_id', 'amount'];

    public function SaleProduct()
    {
        return $this->hasMany(SaleProduct::class, 'sales_id');
    }
}
