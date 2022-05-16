<?php

use App\Models\Faculty;
use App\Models\University;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\{assertDatabaseHas, delete, get, post, put};

beforeEach(fn () => $this->actingAs(User::factory()->create()));

it('can see universities', function () {
    $reponse = get('/universities');
    $reponse
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) =>
            $page->component('universities/index')
                ->count('universities', 0)
        );
});

it('can show universities dashboard', function () {
    $university = University::factory()
        ->hasFaculties(3)
        ->hasInstitutes(3)
        ->create(['email_verified_at' => now()]);

    test()->actingAs(
        $university,
        'university'
    );

    $response = get(route('universities.show'));
    $response
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) =>
            $page->component('universities/dashboard')
                ->where('university.nom', $university->nom)
                ->where('university.faculties_count', 3)
                ->where('university.institutes_count', 3)
                ->whereContains('isVerified', $university->email_verified_at->toDateTime())
        );
});

it('cannot show dashboard for unverified universities', function () {
    test()->actingAs(
        $university = University::factory()->create(),
        'university'
    );

    $response = get(route('universities.show'));
    $response
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) =>
            $page->component('universities/dashboard')
                ->where('isVerified', null)
        );
});

it('can create universities', function () {
    $response = get(route('universities.create'))
        ->assertOk()
        ->assertInertia(fn ($page) => $page->component('universities/create'));
});

it('can store universities', function () {
    $data = University::factory()->raw();
    $response = post(route('universities.store', [
        ...$data, 'password_confirmation' => 'secretsecret'
    ]));
    $response->assertRedirect(RouteServiceProvider::HOME);
    assertDatabaseHas('universities', [
        'nom' => $data['nom']
    ]);
});

it('can verify universities', function () {
    $university = University::factory()->create();
    Event::fake();
    $verificationLink = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $university->id, 'hash' => sha1($university->email)]
    );

    $response = test()->actingAs($university, 'university')->get($verificationLink);

    Event::assertDispatched(Verified::class);
    test()->assertTrue($university->fresh()->hasVerifiedEmail());
    $response->assertRedirect(route('universities.show') . '?verified=1');
});

it('can edit universities', function () {
    $university = University::factory()->create();
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
    $university = University::factory()->create();
    $data = University::factory()->raw();

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
    $university = University::factory()->create();
    $response = delete(route('universities.destroy', $university->id));
    $response->assertRedirect(RouteServiceProvider::HOME);
    test()->assertDatabaseMissing('universities', [
        'nom' => $university->nom
    ]);
});

it('cannot delete universities for redacteurs', function () {
    test()->actingAs($user = User::factory()->create());
    $university = University::factory()->create();
    $response = delete(route('universities.destroy', $university->id));
    $response->assertForbidden();
});
