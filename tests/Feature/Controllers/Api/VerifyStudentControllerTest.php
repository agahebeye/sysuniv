<?php

use App\Enums\LevelType;
use App\Models\Registration;
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

it('can verify students level', function () {
    test()->actingAs(User::factory()->university()->create());

    $student = Student::factory()->create();
    $university = User::factory()->university()->create();
    $registration = Registration::factory()->create([
        'student_id' => $student->id,
        'user_id' => $university->id
    ]);

    $response = getJson(route('students.verify_level', [
        'number' => $student->id,
        'level' => LevelType::BAC_1->value,
    ]));
    
    $response->assertOk();
});
