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
            ->has(Registration::factory()->inFaculty())
            ->count(120)
            ->create();

        \App\Models\Student::factory()
            ->has(Registration::factory()->InInstitute())
            ->count(80)
            ->create();

        \App\Models\Student::factory()
            ->has(Registration::factory()->inFaculty()->abandoned())
            ->count(30)
            ->create();

        \App\Models\Student::factory()
            ->has(Registration::factory()->InInstitute()->abandoned())
            ->count(30)
            ->create();
    }
}
