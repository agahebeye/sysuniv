<?php

use function Pest\Laravel\get;

get('/login')->assertOk();

it('sees a login page', function () {
    $this->get('/login')->assertInertia(
        fn ($page) =>
        $page->component('auth/login')
            ->has('status', null)
    );
});
