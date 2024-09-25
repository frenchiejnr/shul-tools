<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Binyomin Freedman Admin',
            'email' => 'frenchiejnr@gmail.com',
            'password' => 'testpassword',
            'admin' => true
        ]);
        User::factory()->create([
            'name' => 'Binyomin Freedman Also Admin',
            'email' => 'frenchiejnr3@gmail.com',
            'password' => 'testpassword',
            'admin' => true
        ]);
        User::factory()->create([
            'name' => 'Binyomin Freedman Non Admin',
            'email' => 'frenchiejnr2@gmail.com',
            'password' => 'testpassword',
        ]);

        User::factory(1)->create();
    }
}
