<?php

use App\Models\Department;
use App\Models\Faculty;
use App\Models\User;

use function Pest\Laravel\get;

beforeEach(fn () => test()->actingAs(User::factory()->create()));

it('can see departments', function () {
    $this->actingAs($university = User::factory()->university()->create());

    $response = get(route('departments.index'));
    $response->dd();
    dd($response->json());
});
