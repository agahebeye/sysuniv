<?php

use function Pest\Laravel\get;

it('can create university login', function() {
    get(route('universities.login'))
    ->assertOk()
    ->assertInertia(fn($page) => $page->component('universities/auth/login'));
    ;
});