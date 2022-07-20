<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ->has(Registration::factory()->state(function (array $attributes) {
                return [
                    'university_id' => User::university()->inRandomOrder()->value('id'),
                    'university_id' => User::class,
                    'faculty_id' => Faculty::inRandomOrder()->value('id'),
                    'department_id' => Department::inRandomOrder()->value('id'),
                ];
            }))
            ->create();
    }
}
