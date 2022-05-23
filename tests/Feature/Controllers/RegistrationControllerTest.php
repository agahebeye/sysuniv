<?php

use App\Models\User;

use function Pest\Laravel\get;
beforeEach(fn() => $this->actingAs(User::factory()->university()->create()));
it('can create registrations', function () {
    $response = get(route('registrations.create'));
    $response->assertOk();
    $response->assertInertia(fn($page) => $page->component('registrations/create'));
});
