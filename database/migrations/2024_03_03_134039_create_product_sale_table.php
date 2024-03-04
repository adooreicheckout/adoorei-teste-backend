<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('product_sale', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('quantity');
            $table->timestamps();
            $table->foreignUuid('sale_id')->references('id')->on('sale');
            $table->foreign('product_id')->references('id')->on('product');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_sale');
    }
};
