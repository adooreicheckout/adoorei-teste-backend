<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products_by_sale', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->decimal('price', 10, 2);
            $table->foreignId('product_id')->references('id')->on('products');
            $table->foreignId('sale_id')->references('id')->on('sales');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_by_sale');
    }
};
