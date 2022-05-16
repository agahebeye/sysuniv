<?php

use App\Models\Institute;
use App\Models\User;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\{delete, get, post, put};

beforeEach(fn () => $this->actingAs(User::factory()->create()));

it('can see institues', function () {
    Institute::factory(3)->create();
    $response = get(route('institutes.index'))
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) =>
            $page->component('institutes/index')
                ->has('institutes', 3)
        );
});

it('can create institutes', function () {
    get(route('institutes.create'))
        ->assertOk()
        ->assertInertia(fn ($page) => $page->component('institutes/create'));
});

it('can store institutes', function () {
    post(route('institutes.store', ['nom' => 'faculty']))
        ->assertRedirect(route('institutes.index'));

    test()->assertDatabaseHas('institutes', [
        'nom' => 'faculty'
    ]);

    $response = post(route('institutes.store', ['nom' => 'faculty']));
    $response->assertSessionHasErrors([
        'nom'
    ]);
});

it('can edit institutes', function () {
    $faculty = Institute::factory()->createQuietly();
    get(route('institutes.edit', ['faculty' => $faculty->id]))
        ->assertOk()
        ->assertInertia(
            fn ($page) =>
            $page->component('institutes/edit')
                ->has('faculty')
        );
});

it('can update institutes', function () {
    $faculty = Institute::factory()->createQuietly();
    $response = put(route('institutes.update', [
        'faculty' => $faculty->id,
        'nom' => 'new faculty'
    ]));

    $response->assertRedirect(route('institutes.index'));
    assertDatabaseHas('institutes', ['nom' => 'new faculty']);
    assertDatabaseMissing('institutes', ['nom' => $faculty->nom]);
});

it('can soft-delete institutes', function () {
    $faculty = Institute::factory()->createQuietly();
    $response = delete(route('institutes.destroy', ['faculty' => $faculty->id]))
        ->assertRedirect(route('institutes.index'));

    assertSoftDeleted('institutes', [
        'nom' => $faculty->nom
    ]);
});
