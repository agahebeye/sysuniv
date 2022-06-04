<?php

namespace Database\Factories;

use App\Enums\LevelType;
use App\Enums\ResultStatus;
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
            'result_status' => ResultStatus::PENDING->value
        ];
    }

    public function failed()
    {
        return $this->state(
            fn (array $attributes) => ['result_status' => ResultStatus::FAILED]
        );
    }

    public function passed()
    {
        return $this->state(
            fn (array $attributes) => ['result_status' => ResultStatus::PASSED]
        );
    }
}
