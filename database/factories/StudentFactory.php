<?php

namespace Database\Factories;

use App\Enums\GenderType;
use App\Enums\ResultStatus;
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
            'gender' => GenderType::MALE->value,
            'birth_date' => $this->faker->date(),
            'address' => $this->faker->address
        ];
    }

    public function failed()
    {
        return $this->state(
            fn (array $attributes) =>['result_status' => ResultStatus::FAILED]
        );
    }

    public function passed()
    {
        return $this->state(
            fn (array $attributes) =>['result_status' => ResultStatus::PASSED]
        );
    }
}
