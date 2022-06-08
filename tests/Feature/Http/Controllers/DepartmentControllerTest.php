<?php

use App\Models\User;
use App\Enums\LevelType;

use App\Models\Department;
use function Pest\Laravel\get;

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

    createRegistration($university);
    createRegistration(User::factory()->university());

    $response = get(route('departments.index'));

    $response->assertOk()
        ->assertInertia(
            fn ($page) =>
            $page->component('departments/index')
                ->has('departments', 1)
        );
});
