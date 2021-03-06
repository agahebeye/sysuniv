<?php

use App\Models\Faculty;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

beforeEach(fn () => $this->actingAs(User::factory()->create()));

it('can see faculties', function () {
    test()->actingAs($university = User::factory()->university()->create());

    Faculty::factory(3)->create();
    Faculty::factory(5)
        ->hasAttached($university, relationship: 'universities')
        ->create();

    $response = get(route('faculties.index'));

    $response->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) =>
            $page->component('faculties/index')
                ->has('faculties', 5)
        );
});

it('can create faculties', function () {
    get(route('faculties.create'))
        ->assertOk()
        ->assertInertia(fn ($page) => $page->component('faculties/create'));
});

it('can store faculties', function () {
    $response = post(route('faculties.store', ['name' => 'faculty']));

    $response->assertRedirect(route('faculties.index'));

    test()->assertDatabaseHas('faculties', [
        'name' => 'faculty'
    ]);

    $response = post(route('faculties.store', ['name' => 'faculty']));
    $response->assertSessionHasErrors([
        'name'
    ]);
});
