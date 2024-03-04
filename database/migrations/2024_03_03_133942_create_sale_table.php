<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

        DB::unprepared("CREATE EXTENSION IF NOT EXISTS \"uuid-ossp\";");

        Schema::create('sale', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale');
        DB::unprepared("DROP EXTENSION IF EXISTS \"uuid-ossp\";");
    }
};
