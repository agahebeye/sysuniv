<?php

use App\Models\Faculty;
use App\Models\User;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

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

it('can edit faculties', function () {
    $faculty = Faculty::factory()->createQuietly();
    get(route('faculties.edit', ['faculty' => $faculty->id]))
        ->assertOk()
        ->assertInertia(
            fn ($page) =>
            $page->component('faculties/edit')
                ->has('faculty')
        );
});

it('can update faculties', function() {
    $faculty = Faculty::factory()->createQuietly();
    $response = put(route('faculties.update', [
        'faculty' => $faculty->id,
        'nom' => 'new faculty'
    ]));

    $response->assertRedirect(route('faculties.index'));
    assertDatabaseHas('faculties', ['nom' => 'new faculty']);
    assertDatabaseMissing('faculties', ['nom' => $faculty->nom]);
});

it('can soft-delete faculties', function () {
    $faculty = Faculty::factory()->createQuietly();
    $response = delete(route('faculties.destroy', ['faculty' => $faculty->id]))
        ->assertRedirect(route('faculties.index'));

    assertSoftDeleted('faculties', [
        'nom' => $faculty->nom
    ]);
});
