<?php

it('has home page', function () {
    $response = $this->get('/');
    $response->assertInertia(fn($page) => dd($page));

    $response->assertStatus(200);
});
