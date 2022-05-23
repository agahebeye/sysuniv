<?php

use App\Models\Registration;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\{assertDatabaseHas, assertDatabaseMissing, assertModelMissing, delete, get, post, put};

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

    $response = get(route('students.show', $student->id));

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
    $photo = UploadedFile::fake()->image('photo.png');
    $data = [...Student::factory()->raw(), 'photo' => $photo];
    $response = post(route('students.store'), $data);

    Storage::disk('public')->assertExists('avatars/' . $photo->hashName());
});

it('can edit students', function () {
    $student = Student::factory()->create();
    $response = get(route('students.edit', $student->id))
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
        route('students.update', $student->id),
        [
            'firstname' => 'aboubakar',
            'photo' => $photo = UploadedFile::fake()->image('aboubakar.png')
        ]
    )
        ->assertRedirect(route('students.index'));

    assertDatabaseHas('students', ['firstname' => 'aboubakar']);
    assertDatabaseMissing('students', ['firstname' => $student->firstname]);
    expect($student->photo->src)->toEqual("avatars/{$photo->hashName()}");
});
