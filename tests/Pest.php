<?php

use App\Models\Result;
use App\Models\Faculty;
use App\Models\Student;
use App\Enums\LevelType;
use App\Enums\ResultStatus;
use App\Models\Department;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class)->in('Feature');

function createRegistration($university, $level = LevelType::BAC_1, $result_status = ResultStatus::PENDING)
{
    Registration::factory()
        ->has(Result::factory())
        ->for(Faculty::factory())
        ->for(Department::factory())
        ->for($student = Student::factory()->create())
        ->for($university, 'university')
        ->create(['level' => $level, 'result_status' => $result_status]);

    return $student;
}
