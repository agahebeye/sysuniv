<?php

namespace Database\Factories;

use App\Enums\LevelType;
use App\Enums\ResultStatus;
use App\Models\Faculty;
use App\Models\Institute;
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
            'university_id' => User::university()->inRandomOrder()->value('id'),
            'department_id' => Department::inRandomOrder()->value('id'),
        ];
    }

    public function inFaculty()
    {
        return $this->state(
            fn (array $attributes) => ['faculty_id' => Faculty::inRandomOrder()->value('id')]
        );
    }

    public function inInstitute()
    {
        return $this->state(
            fn (array $attributes) => ['institute_id' => Institute::inRandomOrder()->value('id')]
        );
    }

    public function abandoned()
    {
        return $this->state(
            fn (array $attributes) => ['has_abandoned' => true]
        );
    }
}
