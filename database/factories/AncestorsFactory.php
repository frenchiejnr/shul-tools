<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AncestorsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fathers_hebrew_name' =>
            function (array $attributes) {
                return fake()->boolean(70) ? fake()->firstName('male') : fake()->firstName('male') . ' ' . fake()->firstName('male');
            },
            'paternal_grandfather_hebrew_name' =>
            function (array $attributes) {
                return fake()->boolean(70) ? fake()->firstName('male') : fake()->firstName('male') . ' ' . fake()->firstName('male');
            },
            'paternal_grandmother_hebrew_name' =>
            function (array $attributes) {
                return fake()->boolean(70) ? fake()->firstName('female') : fake()->firstName('female') . ' ' . fake()->firstName('female');
            },
            'mothers_hebrew_name' =>
            function (array $attributes) {
                return fake()->boolean(70) ? fake()->firstName('female') : fake()->firstName('female') . ' ' . fake()->firstName('female');
            },
            'maternal_grandfather_hebrew_name' =>
            function (array $attributes) {
                return fake()->boolean(70) ? fake()->firstName('male') : fake()->firstName('male') . ' ' . fake()->firstName('male');
            },
            'maternal_grandmother_hebrew_name' =>
            function (array $attributes) {
                return fake()->boolean(70) ? fake()->firstName('female') : fake()->firstName('female') . ' ' . fake()->firstName('female');
            },
        ];
    }
}
