<?php

use App\Enums\LevelType;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\User;
use App\Providers\RouteServiceProvider;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

beforeEach(fn () => $this->actingAs(User::factory()->university()->create()));
it('can create registrations', function () {
    $response = get(route('registrations.create'));
    $response->assertOk();
    $response->assertInertia(fn ($page) => $page->component('registrations/create'));
});

it('can create registrations for admins or employees', function () {
    test()->actingAs(User::factory()->create());
    $response = get(route('registrations.create'));
    $response->assertForbidden();

    test()->actingAs(User::factory()->admin()->create());
    $response = get(route('registrations.create'));
    $response->assertForbidden();
});

it('can store registrations', function () {
    $student = Student::factory()->create();
    $university = User::factory()->university()->create();
    $faculty = Faculty::factory()->create();

    $response = post(route('registrations.store'), [
        'level' => LevelType::BAC_1->value,
        'student_id' => $student->id,
        'user_id' => $university->id,
        'faculty_id' => $faculty->id,

    ]);

    $response->assertRedirect(RouteServiceProvider::HOME);
});
