<?php

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;

use function Pest\Laravel\{get, post};

it('can create registered users', function () {
    test()->actingAs(User::factory()->create(['role' => UserType::ADMIN]));
    get(route('users.create'))
    ->assertOk()
    ->assertInertia(fn ($page) => $page->component('auth/register'));
});

it('can store registered users', function () {
    Event::fake();
    test()->actingAs(User::factory()->create(['role' => UserType::ADMIN]));

    $response = post(route('users.store'), [
        'name' => 'john doe',
        'email' => 'johndoe@example.com',
        'password' => 'secretsecret',
        'password_confirmation' => 'secretsecret',
        'role' => UserType::EMPLOYEE->value
    ]);

    Event::assertDispatched(Registered::class);

   test()->assertDatabaseHas('users', [
        'name' => 'john doe',
        'email' => 'johndoe@example.com',
    ]);
});

it('cannot store users for non-admins', function() {
    test()->actingAs(User::factory()->create());
    $data = User::factory()->raw();
    $response = post(route('users.store'), [...$data, 'password_confirmation' => 'secretsecret']);
    $response->assertForbidden();
});
