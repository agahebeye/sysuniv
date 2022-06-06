<?php

use App\Enums\UserType;
use App\Models\User;
use App\Providers\RouteServiceProvider;

use function Pest\Laravel\get;

it('can access dashboard', function () {
    test()->actingAs(User::factory()->create(['role' => UserType::EMPLOYEE]));
    get(RouteServiceProvider::HOME)
        ->assertOk()
        ->assertInertia(fn ($page) => $page->component('dashboard'));
});
