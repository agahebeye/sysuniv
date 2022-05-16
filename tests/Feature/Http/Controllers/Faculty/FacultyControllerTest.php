<?php

use App\Models\Faculty;
use App\Models\User;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\delete;
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

it('can create faculties', function () {
    get(route('faculties.create'))
        ->assertOk()
        ->assertInertia(fn ($page) => $page->component('faculties/create'));
});

it('can store faculties', function () {
    post(route('faculties.store', ['nom' => 'faculty']))
        ->assertRedirect(route('faculties.index'));

    test()->assertDatabaseHas('faculties', [
        'nom' => 'faculty'
    ]);

    $response = post(route('faculties.store', ['nom' => 'faculty']));
    $response->assertSessionHasErrors([
        'nom'
    ]);
});

it('can soft-delete faculties', function () {
    $faculty = Faculty::factory()->createQuietly();
    $response = delete(route('faculties.destroy', ['faculty' => $faculty->id]))
        ->assertRedirect(route('faculties.index'));

    assertSoftDeleted('faculties', [
        'nom' => $faculty->nom
    ]);
});
