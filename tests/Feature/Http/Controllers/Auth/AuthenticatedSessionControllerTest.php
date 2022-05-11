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

it('logs in users', function () {
    $user = User::factory()->createQuietly(['password' => 'password']);

    $response = post('/login', ['email' => $user->email, 'password' => 'password']);
    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
