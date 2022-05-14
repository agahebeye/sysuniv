<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\University>
 */
class UniversityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->sentence(),
            'email' => $this->faker->unique()->companyEmail(),
            'password' => 'secretsecret',
            'nif' => Str::random(),
            'siteweb' => "https://{$this->faker->domainName()}",
            'adresse' => $this->faker->address()
        ];
    }
}
