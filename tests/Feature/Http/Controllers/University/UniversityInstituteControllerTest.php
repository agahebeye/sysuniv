<?php

use App\Models\Institute;
use App\Models\University;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;

it('sees institutes of universities', function () {
    $university = University::factory()->create([
        'email_verified_at' => now()
    ]);
    test()->actingAs($university, 'university');
    Institute::factory(3)->hasAttached($university)->create();
    $response = get(route('universities.institutes', $university->id))
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) => $page
                ->component('universities/institutes')
                ->has('institutes', 3)
                ->where('isVerified', true)
        );
});

it('cannot see institutes of unverified universities', function () {
    $university = University::factory()->create();
    test()->actingAs($university, 'university');
    Institute::factory(3)->hasAttached($university)->create();
    get(route('universities.institutes', $university->id))
        ->assertInertia(
            fn ($page) => $page->component('universities/institutes')
                ->where('isVerified', false)
        );
});
