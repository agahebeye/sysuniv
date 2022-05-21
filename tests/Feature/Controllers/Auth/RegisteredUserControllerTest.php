<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;

use function Pest\Laravel\{get, post};

it('can create registered users', function () {
    get(route('users.create'))
    ->assertOk()
    ->assertInertia(fn ($page) => $page->component('auth/register'));
});

it('can store registered users', function () {
    Event::fake();

    $data = User::factory()->raw();
    $response = post(route('users.store'), [
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => 'secretsecret',
        'password_confirmation' => 'secretsecret',
    ]);

    dd($response->json());

    Event::assertDispatched(Registered::class);

    $response->assertRedirect('/login');
    test()->assertDatabaseHas('users', [
        'name' => $data['name'],
        'email' => $data['email']
    ]);
});
