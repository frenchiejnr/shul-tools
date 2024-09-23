<?php

namespace App\Support;

use Illuminate\Support\Facades\Facade;

class HebrewNameGenerator extends Facade
{
    /**
     * Generates a random first name. If the random boolean is true, will append another first name.
     */
    public static function firstName(string $gender): string
    {
        return fake()->boolean(70) ? fake()->firstName($gender) : fake()->firstName($gender) . ' ' . fake()->firstName($gender);
    }
}
