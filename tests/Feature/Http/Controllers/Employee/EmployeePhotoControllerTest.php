<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\get;
use function Pest\Laravel\put;

it('can edit employees photos', function () {
    $this->actingAs($employee = User::factory()->create());

    $response = get(route('employees.photos.edit', $employee->getRouteKey()));
    $response->assertOk()
        ->assertInertia(
            fn ($page) => $page
                ->component('employees/photos/edit')
        );
});

it('can update employees photos', function () {
    Storage::fake('public');

    $this->actingAs($employee = User::factory()->create());
    $photo = UploadedFile::fake()->image('photo.png', 480, 320);

    $response = put(route('employees.photos.update', $employee->getRouteKey()), [
        'photo' => $photo
    ]);

    Storage::disk('public')->assertExists('/avatars/' . $photo->hashName());
    $response->assertRedirect(RouteServiceProvider::HOME);
});
