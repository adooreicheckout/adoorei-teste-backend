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
        Schema::create('vendas_has_produtos', function (Blueprint $table) {
            $table->foreignId('product_id')->references('id')->on('produtos');
            $table->foreignId('sales_id')->references('id')->on('vendas');
            $table->integer("amount")->default(0);
            $table->decimal('price', 10, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas_has_produtos');
    }
};
