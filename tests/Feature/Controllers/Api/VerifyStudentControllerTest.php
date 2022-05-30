<?php

use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Str;

use function Pest\Laravel\getJson;

it('can verify students registration number', function () {
    test()->actingAs(User::factory()->university()->create());
    $student = Student::factory()->create();
    $response = getJson(route('students.verify_number', $student->registration_number));
    $response->assertOk();
});
