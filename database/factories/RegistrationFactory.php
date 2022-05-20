<?php

namespace Database\Factories;

use App\Enums\LevelType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registration>
 */
class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'school_year' => '2019-2020',
            'level' => array_rand(LevelType::cases()),
        ];
    }
}
