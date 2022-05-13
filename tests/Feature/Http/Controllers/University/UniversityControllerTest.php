<?php

use App\Models\University;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\{delete, get, post, put};

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

it('can create universities', function () {
    $user = User::factory()->createQuietly();
    test()->actingAs($user);
    $response = get(route('universities.create'))
        ->assertOk()
        ->assertInertia(fn ($page) => $page->component('universities/create'));
});

it('can store universities', function () {
    $user = User::factory()->createQuietly();
    test()->actingAs($user);
    $response = post(route('universities.store'));
    dump($response->json());
        //->assertRedirect(RouteServiceProvider::HOME);
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
        'nom' => $data['nom'],
        'suspendu' => 1
    ]));

    $response->assertRedirect(RouteServiceProvider::HOME);
    test()->assertDatabaseHas('universities', [
        'nom' => $data['nom'],
        'suspendu' => 1
    ]);
});

it('can delete universities', function () {
    test()->actingAs(User::factory()->admin()->create());
    $university = University::factory()->createQuietly();
    $response = delete(route('universities.destroy', $university->id));
    $response->assertRedirect(RouteServiceProvider::HOME);
    test()->assertDatabaseMissing('universities', [
        'nom' => $university->nom
    ]);
});

it('cannot delete universities for redacteurs', function () {
    test()->actingAs(User::factory()->create());
    $university = University::factory()->createQuietly();
    $response = delete(route('universities.destroy', $university->id));
    $response->assertForbidden();
});
