<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => fake()->name(),
            'hebrew_name' => function (array $attributes) {
                $firstName = fake()->firstName($attributes['gender']);
                $lastName = fake()->firstName();

                if ($attributes['gender'] === 'male') {
                    return "{$firstName} ben {$lastName}";
                }

                return "{$firstName} bas {$lastName}";
            },
        ];
    }
}
