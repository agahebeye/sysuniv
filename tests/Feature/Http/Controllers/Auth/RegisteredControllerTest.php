<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\{get, post};

get('/register')->assertOk();

it('can see the register page', function () {
    get('/register')->assertInertia(fn (AssertableInertia $page) => $page->component('auth/register'));
});

it('can register new users', function () {
    Event::fake();

    $data = User::factory()->raw();
    $response = post('/register', [
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => 'secretsecret',
        'password_confirmation' => 'secretsecret'
    ]);

    Event::assertDispatched(Registered::class);

    $response->assertRedirect('/login');
    test()->assertDatabaseHas('users', [
        'name' => $data['name'],
        'email' => $data['email']
    ]);
});
