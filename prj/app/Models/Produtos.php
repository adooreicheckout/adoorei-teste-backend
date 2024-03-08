<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produtos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "produtos";

    protected $fillable = [
        'name',
        'price',
        'description',
    ];
}
