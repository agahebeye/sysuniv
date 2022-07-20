<?php

namespace Database\Seeders;

use App\Models\Registration;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Student::factory()
            ->has(Registration::factory()->inFaculty()->abandoned())
            ->count(120)
            ->create();

        \App\Models\Student::factory()
            ->has(Registration::factory()->inFaculty()->abandoned())
            ->count(30)
            ->create();
    }
}
