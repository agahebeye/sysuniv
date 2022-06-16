<?php

namespace Database\Factories;

use App\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'secretsecret', // password
            'remember_token' => Str::random(10),
            'role' => UserType::EMPLOYEE->value,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => UserType::ADMIN,
            ];
        });
    }

    public function university()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => UserType::UNIVERSITY,
            ];
        });
    }

    public function employee()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => UserType::EMPLOYEE,
            ];
        });
    }
}
