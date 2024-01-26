<?php

use App\Enums\Sale\SaleStatus as SaleSaleStatus;
use App\Models\Sale\SaleStatus;
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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 8, 2)->index();
            $table->unsignedBigInteger('sale_status_id')->default(SaleSaleStatus::IN_PROGRESS);

            $table->foreign('sale_status_id')->references('id')->on(app(SaleStatus::class)->getTable());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
