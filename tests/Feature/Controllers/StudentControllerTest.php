<?php

use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Str;
use App\Models\Registration;
use Illuminate\Http\UploadedFile;
use Inertia\Testing\AssertableInertia;
use App\Providers\RouteServiceProvider;

use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\{assertDatabaseHas, assertDatabaseMissing, get, getJson, post, put};

beforeEach(fn () => test()->actingAs(User::factory()->create()));

it('can see students', function () {
    test()->actingAs($univeristy = User::factory()->university()->create());

    Student::factory(2)->create();
    Student::factory(3)->has(Registration::factory()->state(['user_id' => $univeristy]))->create();
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
                ->where('student.id', $student->id)
        );
});

it('can create students', function () {
    $response = get(route('students.create'));
    $response->assertOk()
        ->assertInertia(fn ($page) => $page->component('students/create'));
});

it('can store students', function () {
    Storage::fake('public');
    $photo = UploadedFile::fake()->create('photo.png');
    $data = [...Student::factory()->raw(), 'photo' => $photo];
    $response = post(route('students.store'), $data);

    Storage::disk('public')->assertExists('avatars/' . $photo->hashName());
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
    Storage::fake('public');
    $student = Student::factory()->create();
    $student->photo()->create(['src' => 'photo.png']);

    $response = put(
        route('students.update', $student->getRouteKey()),
        [
            'firstname' => 'aboubakar',
            'photo' => $photo = UploadedFile::fake()->image('aboubakar.png')
        ]
    )
        ->assertRedirect(RouteServiceProvider::HOME);

    assertDatabaseHas('students', ['firstname' => 'aboubakar']);
    assertDatabaseMissing('students', ['firstname' => $student->firstname]);
    expect($student->photo->src)->toEqual("avatars/{$photo->hashName()}");
});

it('can verify registration numbers', function () {
    test()->actingAs(User::factory()->university()->create());
    $student = Student::factory()->create();
    $response = getJson(route('students.registrations.number', $student->registration_number));
    $response->assertOk();
});
