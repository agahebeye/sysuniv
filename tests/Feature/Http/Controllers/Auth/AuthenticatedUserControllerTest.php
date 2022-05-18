<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;

use function Pest\Laravel\{get, post};
use Inertia\Testing\AssertableInertia as Assert;

it('can create users login', function () {
    get('/login')
    ->assertOk()
    ->assertInertia(
        fn (Assert $page) =>
        $page->component('auth/login')
            ->has('status', null)
    );
});

it('can store users login', function () {
    $user = User::factory()->createQuietly(['password' => 'password']);
    $response = post('/login', ['email' => $user->email, 'password' => 'password']);
    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

it('cannot create users login with invalid password', function () {
    $user = User::factory()->createQuietly();
    $response = post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);
    $response->assertSessionHasErrors(['email']);
    test()->assertGuest();
});


it('can destroy users login', function() {
    $user = User::factory()->createQuietly(['password' => 'password']);
    test()->actingAs($user, 'web');
    post('/logout');
    test()->assertGuest();
});

