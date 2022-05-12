<?php

use App\Models\University;
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

it('can edit universities', function () {
    $user = User::factory()->forRole()->createQuietly();
    $university = University::factory()->createQuietly();
    test()->actingAs($user);
    get(route('universities.edit', $university->id))
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) =>
            $page->component('universities/edit')
                ->has('university')
                ->where('university.id', $university->id)
        );
});

it('can update universities', function () {
    $user = User::factory()->forRole()->createQuietly();
    $university = University::factory()->createQuietly();
    $data = University::factory()->raw();
    test()->actingAs($user);

    $response = put(route('universities.update', [
        'university' => $university->id,
        'nom' => $data['nom']
    ]));
});
