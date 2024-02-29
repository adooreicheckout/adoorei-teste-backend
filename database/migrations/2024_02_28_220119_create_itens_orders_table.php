<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItensOrdersTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('itens_orders')) {
            Schema::create('itens_orders', function (Blueprint $table) {
                $table->uuid('itens_id')->primary();
                $table->unsignedBigInteger('order_id');
                $table->unsignedBigInteger('product_id');
                $table->timestamps();
        
                $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('itens_orders');
 
    }
}