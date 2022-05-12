<?php

use App\Enums\RoleStatus;
use App\Models\Role;
use App\Models\User;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;

it('can see universities page', function () {
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

it('updates universities', function () {
    $user = User::factory()->admin()->create();
    dd($user->role->toArray());
});
