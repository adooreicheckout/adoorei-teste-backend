<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendasModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "vendas";

    protected $fillable = [
        'amount',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function products(){
        return $this->belongsToMany(ProdutosModel::class, 'vendas_has_produtos', 'sales_id', 'product_id')->withPivot(['price', 'amount']);
    }
}
