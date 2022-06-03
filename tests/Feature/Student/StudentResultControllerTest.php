<?php

use App\Models\User;

use App\Models\Student;
use function Pest\Laravel\get;

it('can create students results', function () {
    test()->actingAs(User::factory()->university()->create());
    $student = Student::factory()->create();
    $response = get(route('students.results.create', $student->getRouteKey()));
    $response->assertInertia(fn($page) => $page->component('students/results/create'));
});
