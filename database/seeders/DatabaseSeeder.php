<?php

namespace Database\Seeders;

use App\Models\Ancestors;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'Binyomin Freedman',
            'email' => 'frenchiejnr@gmail.com',
            'password' => 'testpassword',
        ]);
        User::factory()->create([
            'name' => 'Binyomin Freedman Non Admin',
            'email' => 'frenchiejnr2@gmail.com',
            'password' => 'testpassword',
        ]);

        User::factory(10)->create();
        Ancestors::factory(21)->create();
        $this->call(ShulMembersSeeder::class);
    }
}
