<?php

use App\Models\User;
use App\Enums\UserType;
use App\Models\Faculty;
use App\Models\Institute;
use App\Notifications\UniversityRegistered;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Event;

use Inertia\Testing\AssertableInertia;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Notification;

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

it('can create universities', function () {
    $response = get(route('universities.create'))
        ->assertOk()
        ->assertInertia(fn ($page) => $page->component('universities/create'));
});

it('can store universities', function () {
    Notification::fake();

    $faculties = Faculty::factory(3)->create();
    $institutes = Institute::factory(2)->create();

    $data = User::factory()->university()->raw();

    $response = post(route('universities.store', [
        ...$data,
        'password_confirmation' => 'secretsecret',
        'website' => 'https://johndoe.org',
        'address' => 'home',
        'faculties' => $faculties->map(fn ($faculty) => ['id' => $faculty->id])->flatten()->toArray(),
        'institutes' => $institutes->map(fn ($institute) => ['id' => $institute->id])->flatten()->toArray(),
    ]));

    Notification::assertSentTo(User::university()->latest()->first(), UniversityRegistered::class);

    $response->assertRedirect(route('universities.index'));

    assertDatabaseHas('users', [
        'name' => $data['name'],
        'role' => UserType::UNIVERSITY->value
    ]);

    assertDatabaseHas('universities_institutes', [
        'user_id' => User::university()->latest()->first()->id,
        'institute_id' => $institutes[0]->id,
    ]);
});

it('can verify universities', function () {
    $university = User::factory()->university()->create(['email_verified_at' => null]);

    Event::fake();

    $verificationLink = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $university->id, 'hash' => sha1($university->email)]
    );

    $response = test()->actingAs($university)->get($verificationLink);
    
    //Event::assertDispatched(Verified::class);
    test()->assertTrue($university->fresh()->hasVerifiedEmail());
    $response->assertRedirect(RouteServiceProvider::HOME . '?verified=1');
});
