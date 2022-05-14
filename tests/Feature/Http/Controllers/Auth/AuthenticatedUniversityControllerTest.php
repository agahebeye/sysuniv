<?php

use App\Models\University;

use function Pest\Laravel\{get, post};

it('can create university login', function () {
    get(route('universities.login'))
        ->assertOk()
        ->assertInertia(fn ($page) => $page->component('universities/auth/login'));;
});

it('can store university login', function () {
    $university = University::factory()->create();

    post(route('universities.login', [
        'nom' => $university->nom,
        'email' => $university->email,
        'password' => 'secretsecret',
    ]))->assertRedirect(route('universities.show'));

    test()->assertAuthenticated('university');
});
