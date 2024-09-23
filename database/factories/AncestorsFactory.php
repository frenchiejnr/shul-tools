<?php

namespace Database\Factories;

use App\Support\HebrewNameGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AncestorsFactory extends Factory
{
    public function definition(): array
    {

        return [
            'fathers_hebrew_name' => HebrewNameGenerator::firstName('male'),
            'paternal_grandfather_hebrew_name' => HebrewNameGenerator::firstName('male'),
            'paternal_grandmother_hebrew_name' => HebrewNameGenerator::firstName('female'),
            'mothers_hebrew_name' => HebrewNameGenerator::firstName('female'),
            'maternal_grandfather_hebrew_name' => HebrewNameGenerator::firstName('male'),
            'maternal_grandmother_hebrew_name' => HebrewNameGenerator::firstName('female'),
        ];
    }
}
