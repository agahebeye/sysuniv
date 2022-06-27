<?php

use App\Enums\LevelType;
use App\Models\Department;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Photo;
use App\Models\Student;
use App\Models\Registration;
use Illuminate\Http\UploadedFile;
use Inertia\Testing\AssertableInertia;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\{assertDatabaseHas, assertDatabaseMissing, get, post, put};

beforeEach(fn () => test()->actingAs(User::factory()->create()));

it('can see students', function () {
    test()->actingAs($univeristy = User::factory()->university()->create());

    Student::factory(2)->create();
    Student::factory(3)->has(Photo::factory())->has(
        Registration::factory()->for(Faculty::factory())->for(Department::factory())->for($univeristy, 'university')->state(['level' => LevelType::BAC_2])
    )->create();
    $response = get(route('students.index'));

    $response->assertInertia(
        fn (AssertableInertia $page) =>
        $page->component('students/index')
            ->has('students', 3)
    );
});

it('can show students', function () {
    $student = Student::factory()->create();

    $response = get(route('students.show', $student->getRouteKey()));

    $response->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) =>
            $page->component('students/show')
                ->has('student')
                ->where('student.firstname', $student->firstname)
        );
});

it('can create students', function () {
    $response = get(route('students.create'));
    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('students/create'));
});

it('can store students', function () {
    $photo = UploadedFile::fake()->create('photo.png');
    $data = Student::factory()->raw();
    $response = post(route('students.store'), $data);
    assertDatabaseHas('students', [
        'firstname' => $data['firstname'],
        'lastname' => $data['lastname']
    ]);

    $student = Student::latest()->first();
    $response->assertSessionHas(
        'success',
        "Le numéro matricule de {$student->firstname} uniquement généré est:  $student->registration_number"
    );
    $response->assertRedirect(route('students.photos.create', $student->getRouteKey()));
});

it('can edit students', function () {
    $student = Student::factory()->create();
    $response = get(route('students.edit', $student->getRouteKey()))
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) =>
            $page->component('students/edit')
                ->has('student')
                ->where('student.id', $student->id)
        );
});

it('can update students', function () {
    $student = Student::factory()->create();

    $response = put(
        route('students.update', $student->getRouteKey()),
        [
            'firstname' => 'aboubakar',
        ]
    );

    $response->assertRedirect(RouteServiceProvider::HOME);

    assertDatabaseHas('students', ['firstname' => 'aboubakar']);
    assertDatabaseMissing('students', ['firstname' => $student->firstname]);
});
