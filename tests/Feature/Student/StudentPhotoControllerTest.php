<?php

use App\Models\Student;
use App\Models\User;
use function Pest\Laravel\get;
use function Pest\Laravel\put;

use Illuminate\Http\UploadedFile;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;

beforeEach(fn () => $this->actingAs(User::factory()->create()));

it('can create students photos', function () {
    $student = Student::factory()->create();

    $response = get(route('students.photos.create', $student->getRouteKey()));
    dd($response->json());
    $response->assertOk()
        ->assertInertia(
            fn ($page) => $page
                ->component('students/photos/create')
        );
});

it('can store students photos', function () {
    Storage::fake('public');

    $student = Student::factory()->create();
    $photo = UploadedFile::fake()->image('photo.png', 480, 320);

    $response = put(route('students.photos.store', $student->getRouteKey()), [
        'photo' => $photo
    ]);

    Storage::disk('public')->assertExists('/avatars/' . $photo->hashName());
    $response->assertRedirect(RouteServiceProvider::HOME);
});
