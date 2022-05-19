<?php

namespace Database\Factories;

use App\Enums\GenderType;
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
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'gender' => array_rand(GenderType::cases()),
            'birth_date' => $this->faker->date(),
            'address' => $this->faker->address
        ];
    }
}
