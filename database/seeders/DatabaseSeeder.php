<?php

namespace Database\Seeders;

use App\Models\Ancestors;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        Ancestors::factory(21)->create();
        $this->call(ShulMembersSeeder::class);
    }
}
