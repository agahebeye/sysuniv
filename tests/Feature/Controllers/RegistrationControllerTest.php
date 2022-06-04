<?php

use App\Enums\LevelType;
use App\Models\Faculty;
use App\Models\Registration;
use App\Models\Result;
use App\Models\Student;
use App\Models\User;
use App\Providers\RouteServiceProvider;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('can create registrations', function () {
    $this->actingAs(User::factory()->university()->create());
    $response = get(route('registrations.create'));
    $response->assertOk();
    $response->assertInertia(fn ($page) => $page->component('registrations/create'));
});

it('cannot create registrations for admins or employees', function () {
    test()->actingAs(User::factory()->create());
    $response = get(route('registrations.create'));
    $response->assertForbidden();

    test()->actingAs(User::factory()->admin()->create());
    $response = get(route('registrations.create'));
    $response->assertForbidden();
});

it('can store registrations', function () {
    $this->actingAs($university = User::factory()->university()->create());
    $student = Student::factory()->create();
    $faculty = Faculty::factory()->create();

    $response = post(route('registrations.store', $student->getRouteKey()), [
        'level' => LevelType::BAC_1->value,
        'university_id' => $university->id,
        'faculty_id' => $faculty->id,
    ]);

    test()->assertDatabaseHas('registrations', [
        'student_id' => $student->id,
        'level' => LevelType::BAC_1->value,
        'university_id' => $university->id,
        'faculty_id' => $faculty->id,
    ]);

    test()->assertDatabaseCount('results', 1);

    $response->assertRedirect(RouteServiceProvider::HOME);
});

it('cannot register students twice in the same year', function () {
    $this->actingAs($university = User::factory()->university()->create());

    $faculty = Faculty::factory()->create();
    $student = Student::factory()->create();
    $registration = Registration::factory()
        ->for($student)
        ->for($faculty)->for($university, 'university')->create();

    $registration->result()->create();

    $response = post(route('registrations.store', $student->getRouteKey()), [
        'level' => LevelType::BAC_1->value,
        'university_id' => $university->id,
        'faculty_id' => $faculty->id,
    ]);

    $response->assertSessionHasErrors(['student_id' => "you have to finish this year to register anew"]);
});

it('cannot register students in the next year after failing', function () {
    $this->actingAs($university = User::factory()->university()->create());

    $faculty = Faculty::factory()->create();
    $student = Student::factory()->failed()->create();
    $registration = Registration::factory()
        ->for($student)
        ->for($faculty)->for($university, 'university')->create([
            'level' => LevelType::BAC_1
        ]);

    $registration->result()->create();

    $response = post(route('registrations.store', $student->getRouteKey()), [
        'level' => LevelType::BAC_2->value,
        'university_id' => $university->id,
        'faculty_id' => $faculty->id,
    ]);

    $response->assertSessionHasErrors(['student_id' => "you cannot register in the next year while you failed the previous one"]);
});
