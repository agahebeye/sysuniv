<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;

use function Pest\Laravel\{get, post};

it('can create registered users', function () {
    get('/register')
    ->assertOk()
    ->assertInertia(fn ($page) => $page->component('auth/register'));
});

it('can store registered users', function () {
    Event::fake();

    $data = User::factory()->raw();
    $response = post('/register', [
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => 'secretsecret',
        'password_confirmation' => 'secretsecret',
    ]);

    Event::assertDispatched(Registered::class);

    $response->assertRedirect('/login');
    test()->assertDatabaseHas('users', [
        'name' => $data['name'],
        'email' => $data['email']
    ]);
});
