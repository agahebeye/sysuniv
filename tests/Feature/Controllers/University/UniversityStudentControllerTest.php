<?php

use App\Models\Student;
use App\Models\University;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;

it('can see students of universities', function () {
    $university = University::factory()->create([
        'email_verified_at' => now()
    ]);
    test()->actingAs($university, 'university');
    Student::factory(3)->hasAttached($university)->create();
    $response = get(route('universities.students', $university->id))
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) => $page
                ->component('universities/students')
                ->has('students', 3)
                ->where('isVerified', true)
        );
});

it('cannot see students of unverified universities', function () {
    $university = University::factory()->create();
    test()->actingAs($university, 'university');
    Student::factory(3)->hasAttached($university)->create();
    get(route('universities.students', $university->id))
        ->assertInertia(
            fn ($page) => $page->component('universities/students')
                ->where('isVerified', false)
        );
});
