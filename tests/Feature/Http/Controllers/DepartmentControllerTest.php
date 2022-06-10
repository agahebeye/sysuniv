<?php

use App\Models\User;
use App\Enums\LevelType;

use App\Models\Department;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

beforeEach(fn () => test()->actingAs(User::factory()->create()));

it('can see departments', function () {
    Department::factory(3)->create();
    $response = get(route('departments.index'));
    $response->assertOk()
        ->assertInertia(
            fn ($page) =>
            $page->component('departments/index')
                ->has('departments', 3)
        );
});

it('can see departments of universities', function () {
    $this->actingAs($university = User::factory()->university()->create());

    Department::factory(3)->create();

    Department::factory(2)->hasAttached($university, relationship:'universities')->create();

    $response = get(route('departments.index'));

    $response->assertOk()
        ->assertInertia(
            fn ($page) =>
            $page->component('departments/index')
                ->has('departments', 2)
        );
});

it('can create departments', function () {
    $response = get(route('departments.create'));
    $response->assertOk()
        ->assertInertia(
            fn ($page) =>
            $page->component('departments/create')
        );
});

it('can store departments', function () {
    $response = post(route('departments.store'), ['name' => 'Genie Logiciel']);
    $response->assertRedirect(route('departments.index'));
    assertDatabaseHas('departments', ['name' => 'Genie Logiciel']);
});
