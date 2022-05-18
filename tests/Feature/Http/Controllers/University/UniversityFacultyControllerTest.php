<?php

use App\Models\Faculty;
use App\Models\University;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;

it('sees faculties of universities', function () {
    $university = University::factory()->create([
        'email_verified_at' => now()
    ]);
    test()->actingAs($university, 'university');
    Faculty::factory(3)->hasAttached($university)->create();
    $response = get(route('universities.faculties', $university->id))
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) => $page
                ->component('universities/faculties')
                ->has('faculties', 3)
                ->where('isVerified', true)
        );
});

it('cannot see faculties of unverified universities', function () {
    $university = University::factory()->create();
    test()->actingAs($university, 'university');
    Faculty::factory(3)->hasAttached($university)->create();
    get(route('universities.faculties', $university->id))
        ->assertInertia(
            fn ($page) => $page->component('universities/faculties')
                ->where('isVerified', false)
        );
});
