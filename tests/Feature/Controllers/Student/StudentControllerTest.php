<?php

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

beforeEach(fn () => test()->actingAs(User::factory()->create()));

it('can see students', function () {
    Student::factory(5)->create();
    $response = get(route('students.index'))
        ->assertInertia(
            fn (AssertableInertia $page) =>
            $page->component('students/index')
                ->has('students', 5)
                ->has('students.0.photo')
        );
});

it('can show a student', function () {
    $student = Student::factory()->create();
    $response = get(route('students.show', $student->id))
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) =>
            $page->component('students/show')
                ->has('student')
                ->where('student.id', $student->id)
        );
});

it('can create students', function () {
    get(route('students.create'))
        ->assertOk()
        ->assertInertia(fn ($page) => $page->component('students/create'));
});

it('can store students', function () {
    Storage::fake('public');
    $photo = UploadedFile::fake()->image('photo.png');
    $data = [...Student::factory()->raw(), 'photo' => $photo];
    $response = post(route('students.store'), $data);

    Storage::disk('public')->assertExists('avatars/' . $photo->hashName());
});
