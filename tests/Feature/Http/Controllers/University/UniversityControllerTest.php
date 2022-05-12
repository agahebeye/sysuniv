<?php

use App\Models\Role;
use App\Models\User;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;
use function Pest\Laravel\put;

it('can see universities', function () {
    //assuming writter logged in
    test()->actingAs(User::factory()->create());
    $reponse = get('/universities');
    $reponse
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) =>
            $page->component('universities/index')
                ->count('universities', 0)
        );
});

it('can update universities', function () {
    $user = User::factory()->forRole()->create();
    test()->actingAs($user);
   /* $response = put(route('universties.update.create'))
        ->assertOk();*/
});
