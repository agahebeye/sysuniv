<?php

use App\Models\Faculty;
use App\Models\User;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

beforeEach(fn () => $this->actingAs(User::factory()->create()));

it('can see faculties', function () {
    Faculty::factory(3)->create();
    $response = get(route('faculties.index'))
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) =>
            $page->component('faculties/index')
            ->has('faculties', 3)
        );
});

it('can create faculties', function() {
    $response = post(route('faculties.create'));
    dd($response->json());
});