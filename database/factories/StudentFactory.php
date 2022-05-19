<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'serial_number' => Str::random(10),
            'firstname' => $this->faker->firstName(),
            'lastnmame' => $this->faker->lastName(),
            'gender' => $this->faker->numberBetween(int2: 1),
            'birth_date' => $this->faker->dateTimeBetween(endDate: now()->subYears(18)),
            'address' => $this->faker->address
        ];
    }
}
