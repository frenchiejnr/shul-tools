<?php

namespace Database\Seeders;

use App\Models\ShulMembers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ShulMembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        ShulMembers::factory()
            ->count(10)
            ->state(function (array $attributes) {
                return [
                    'gender' => fake()->randomElement(['male', 'female']),
                ];
            })
            ->create();
    }
}
