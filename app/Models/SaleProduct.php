<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sale_products';

    protected $fillable = [
        'sale_id', //Criar chave composta com product_id
        'product_id',
        'nome', // Apesar do nome estar no formato PT-BR diferente do restante, segui a risca a documentação 
        'price',
        'amount'
    ];

    protected $hidden = [
        'id',
        'sale_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
