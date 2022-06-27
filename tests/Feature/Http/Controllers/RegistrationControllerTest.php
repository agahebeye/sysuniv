<?php

use App\Enums\LevelType;
use App\Enums\ResultStatus;
use App\Models\Department;
use App\Models\Faculty;
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
    $department = Department::factory()->create();

    $response = post(route('registrations.store', $student->getRouteKey()), [
        'level' => LevelType::BAC_1->value,
        'university_id' => $university->id,
        'faculty_id' => $faculty->id,
        'department_id' => $department->id
    ]);

    test()->assertDatabaseHas('registrations', [
        'student_id' => $student->id,
        'level' => LevelType::BAC_1->value,
        'university_id' => $university->id,
        'faculty_id' => $faculty->id,
        'department_id' => $department->id
    ]);


    test()->assertDatabaseCount('results', 1);

    $response->assertSessionHas('success', "L'étudiant a été enregistré avec succès.");

    $response->assertRedirect(route('students.index'));
});

it('cannot register students twice in the same year', function () {
    $this->actingAs($university = User::factory()->university()->create());

    $student = createRegistration($university);

    $response = post(route('registrations.store', $student->getRouteKey()), [
        'level' => LevelType::BAC_1->value,
        'university_id' => $university->id,
        'faculty_id' => Faculty::query()->latest()->first()->id,
        'department_id' => Department::query()->latest()->first()->id
    ]);

    $response->assertSessionHasErrors(['student_id' => "Vous devez d'abord terminer cette année pour se réinscrire."]);
});

it('cannot register failed students in the next year after failing', function () {
    $this->actingAs($university = User::factory()->university()->create());

    $student = createRegistration($university, result_status: ResultStatus::FAILED);

    $response = post(route('registrations.store', $student->getRouteKey()), [
        'level' => LevelType::BAC_2->value,
        'university_id' => $university->id,
        'faculty_id' => Faculty::query()->latest()->first()->id,
        'department_id' => Department::query()->latest()->first()->id
    ]);

    $response->assertSessionHasErrors(['student_id' => "Vous ne pouvez pas s'inscrire dans l'année suivante sans avoir terminé la précedente."]);
});

it('cannot allow passed students to skip unstudied year', function () {
    $this->actingAs($university = User::factory()->university()->create());
    $student = createRegistration($university, result_status: ResultStatus::PASSED);
    $response = post(route('registrations.store', $student->getRouteKey()), [
        'level' => LevelType::BAC_3->value,
        'university_id' => $university->id,
        'faculty_id' => Faculty::query()->latest()->first()->id,
        'department_id' => Department::query()->latest()->first()->id
    ]);

    $response->assertSessionHasErrors(['student_id' => "Vous ne pouvez pas s'inscrire dans l'année suivante sans avoir terminé la précedente."]);
});

it('cannot register failed students in the year they already studied', function () {
    $this->actingAs($university = User::factory()->university()->create());
    $student = createRegistration($university, LevelType::BAC_2, ResultStatus::FAILED);
    $response = post(route('registrations.store', $student->getRouteKey()), [
        'level' => LevelType::BAC_1->value,
        'university_id' => $university->id,
        'faculty_id' => Faculty::query()->latest()->first()->id,
        'department_id' => Department::query()->latest()->first()->id
    ]);

    $response->assertSessionHasErrors(['student_id' => "Vous ne pouvez pas reprendre l'année précedente."]);
});

it('cannot register passed students in the same year twice', function () {
    $this->actingAs($university = User::factory()->university()->create());
    $student = createRegistration($university, result_status: ResultStatus::PASSED);

    $response = post(route('registrations.store', $student->getRouteKey()), [
        'level' => LevelType::BAC_1->value,
        'university_id' => $university->id,
        'faculty_id' => Faculty::query()->latest()->first()->id,
        'department_id' => Department::query()->latest()->first()->id
    ]);

    $response->assertSessionHasErrors(['student_id' => "Vous ne pouvez pas étudier la même année deux fois."]);
});

it('cannot register passed students in the year they already studied', function () {
    $this->actingAs($university = User::factory()->university()->create());
    $student = createRegistration($university, LevelType::BAC_3, ResultStatus::PASSED);

    $response = post(route('registrations.store', $student->getRouteKey()), [
        'level' => LevelType::BAC_1->value,
        'university_id' => $university->id,
        'faculty_id' => Faculty::query()->latest()->first()->id,
        'department_id' => Department::query()->latest()->first()->id
    ]);

    $response->assertSessionHasErrors(['student_id' => "Vous ne pouvez pas reprendre l'année précedente."]);
});

it('can register passed students in the next year', function () {
    $this->actingAs($university = User::factory()->university()->create());
    $student = createRegistration($university, result_status: ResultStatus::PASSED);

    $response = post(route('registrations.store', $student->getRouteKey()), [
        'level' => LevelType::BAC_2->value,
        'university_id' => $university->id,
        'faculty_id' => Faculty::query()->latest()->first()->id,
        'department_id' => Department::query()->latest()->first()->id
    ]);

    $response->assertRedirect(route('students.index'));
});
