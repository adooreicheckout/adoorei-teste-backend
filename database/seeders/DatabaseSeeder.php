<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cellphone;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Cellphone::factory(100)->create();
    }
}
