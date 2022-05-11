<?php

it('has home page', function () {
    $response = $this->get('/home');

    $response->assertStatus(200);
});
