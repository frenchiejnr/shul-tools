<?php

namespace Database\Factories;

use App\Models\Ancestors;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Support\HebrewNameGenerator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShulMembers>
 */
class ShulMembersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => function (array $attributes) {
                return fake()->name($attributes['gender']);
            },
            'hebrew_name' => function (array $attributes) {
                return HebrewNameGenerator::firstName($attributes['gender']);
            },
            'ancestors_id' => fake()->unique()->numberBetween(1, Ancestors::count()),
        ];
    }
}
