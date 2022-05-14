<?php

use function Pest\Laravel\{get, post};

it('can create university login', function () {
    get(route('universities.login'))
        ->assertOk()
        ->assertInertia(fn ($page) => $page->component('universities/auth/login'));;
});

it('can store university login', function () {
    $response = post(route('universities.login'));
    dd($response->json());
});
