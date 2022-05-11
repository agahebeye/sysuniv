<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;

use function Pest\Laravel\{get, post};
use Inertia\Testing\AssertableInertia as Assert;

get('/login')->assertOk();

it('sees a login page', function () {
    get('/login')->assertInertia(
        fn (Assert $page) =>
        $page->component('auth/login')
            ->has('status', null)
    );
});

it('can authenticate users', function () {
    $user = User::factory()->createQuietly(['password' => 'password']);
    $response = post('/login', ['email' => $user->email, 'password' => 'password']);
    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

it('can not authenticate users with invalid password', function () {
    $user = User::factory()->createQuietly();
    $response = post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);
    $response->assertSessionHasErrors(['email']);
    test()->assertGuest();
});


it('can log users out', function() {
    $user = User::factory()->createQuietly(['password' => 'password']);
    test()->actingAs($user, 'web');
    post('/logout');
    test()->assertGuest();
});

