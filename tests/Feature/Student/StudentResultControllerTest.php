<?php

use App\Models\User;

use App\Models\Student;
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
    test()->actingAs(User::factory()->university()->create());
    $student = Student::factory()->create();
    $response = put(route('students.results.update', $student->getRouteKey()));
    $response->assertRedirect(route('students.index'));
});
