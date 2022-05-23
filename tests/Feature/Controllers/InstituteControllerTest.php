<?php

use App\Models\Institute;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\{ get, post};

beforeEach(fn () => $this->actingAs(User::factory()->create()));

it('can see institutes', function () {
    $university = User::factory()->university()->create();

    test()->actingAs($university);

    Institute::factory(3)->create();
    Institute::factory(4)->hasAttached($university, relationship: 'universities')->create();
    $response = get(route('institutes.index'))
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) =>
            $page->component('institutes/index')
                ->has('institutes', 4)
        );
});

it('can create institutes', function () {
    get(route('institutes.create'))
        ->assertOk()
        ->assertInertia(fn ($page) => $page->component('institutes/create'));
});

it('can store institutes', function () {
    $response = post(route('institutes.store'), ['name' => 'faculty']);
    
    $response->assertRedirect(RouteServiceProvider::HOME);

    test()->assertDatabaseHas('institutes', [
        'name' => 'faculty'
    ]);

    $response = post(route('institutes.store', ['name' => 'faculty']));
    $response->assertSessionHasErrors([
        'name'
    ]);
});

