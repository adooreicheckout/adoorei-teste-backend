<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleProductsTable extends Migration
{
    public function up()
    {
        Schema::create('sale_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sales_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('amount');
            $table->timestamps();

            $table->foreign('sales_id')
                ->references('id')
                ->on('sales');

            $table->foreign('product_id')
                ->references('id')
                ->on('products');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sale_products');
    }
}
