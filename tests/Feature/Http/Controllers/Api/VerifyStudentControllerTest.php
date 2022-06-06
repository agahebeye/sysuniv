<?php

use App\Enums\LevelType;
use App\Models\Registration;
use App\Models\User;
use App\Models\Student;

use function Pest\Laravel\getJson;

it('can verify students', function () {
    test()->actingAs(User::factory()->university()->create());
    $student = Student::factory()->create();
    $response = getJson(route('students.verify', $student->registration_number));
    $response->assertOk();
});