<?php

use App\Models\User;
use App\Models\Result;

use App\Models\Faculty;
use App\Models\Student;
use App\Enums\LevelType;
use App\Enums\ResultStatus;
use App\Models\Registration;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\put;

it('can create students results', function () {
    test()->actingAs(User::factory()->university()->create());
    $student = Student::factory()->create();
    $response = get(route('students.results.create', $student->getRouteKey()));
    $response->assertInertia(
        fn ($page) =>
        $page->component('students/results/create')
            ->has('student')
            ->where('student.id', $student->id)
    );
});

it('can update students results', function () {
    test()->actingAs($university = User::factory()->university()->create());

    $faculty = Faculty::factory()->create();
    $student = Student::factory()->create();
    $registration = Registration::factory()
        ->for($student)
        ->for($faculty)->for($university, 'university')->create(['level' => LevelType::BAC_1]);

    $registration->result()->create();

    $response = put(
        route('students.results.update', $student->getRouteKey()),
        ['notes' => 50.5, 'credits' => 7]
    );

    assertDatabaseHas('registrations', [
        'result_status' => ResultStatus::FAILED->value
    ]);

    $response->assertRedirect(route('students.index'));
});
