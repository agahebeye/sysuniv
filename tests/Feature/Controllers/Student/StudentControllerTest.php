<?php

use App\Models\Student;
use App\Models\User;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

beforeEach(fn () => test()->actingAs(User::factory()->create()));

it('can see students', function () {
    Student::factory(5)->create();
    $response = get(route('students.index'))
        ->assertInertia(
            fn (AssertableInertia $page) =>
            $page->component('students/index')
                ->has('students', 5)
                ->has('students.0.photo')
        );
});

it('can create students', function () {
    get(route('students.create'))
        ->assertOk()
        ->assertInertia(fn ($page) => $page->component('students/create'));
});

it('can store students', function () {
    $data = Student::factory()->raw();
    $response = post(route('students.store', $data));
    dd($response->json());
});
