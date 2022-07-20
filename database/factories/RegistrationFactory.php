<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Faculty;
use App\Models\Institute;
use App\Models\Department;
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
            'level' => rand(0, 2),
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
