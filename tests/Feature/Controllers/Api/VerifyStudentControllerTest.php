<?php

use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Str;

use function Pest\Laravel\getJson;

it('can verify students', function () {
    test()->actingAs(User::factory()->university()->create());
    $student = Student::factory()->create();
    $response = getJson(route('students.verify', $student->registration_number));
    $response->assertOk();
});

it('cannot verify unregistered students', function() {
    test()->actingAs(User::factory()->university()->create());
    $registration_number = Str::random(25);
        $response = getJson(route('students.verify', $registration_number));
        $response->assertNotFound();
});
