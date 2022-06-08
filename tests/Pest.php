<?php

use App\Models\Result;
use App\Models\Faculty;
use App\Models\Student;
use App\Enums\LevelType;
use App\Models\Department;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class)->in('Feature');

function createRegistration($university, $level = LevelType::BAC_1)
{
    Registration::factory()
        ->has(Result::factory())
        ->for(Faculty::factory())
        ->for(Department::factory())
        ->for(Student::factory())
        ->for($university, 'university')
        ->create(['level' => $level]);
}
