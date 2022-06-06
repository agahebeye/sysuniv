<?php

use App\Models\User;
use function Pest\Laravel\get;
use function Pest\Laravel\put;

use Illuminate\Http\UploadedFile;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;

it('can edit universities photos', function () {
    $this->actingAs($university = User::factory()->university()->create());

    $response = get(route('universities.photos.edit', $university->getRouteKey()));
    $response->assertOk()
        ->assertInertia(
            fn ($page) => $page
                ->component('universities/photos/edit')
        );
});

it('can update universities photos', function() {
    Storage::fake('public');

    $this->actingAs($university = User::factory()->university()->create());
    $photo = UploadedFile::fake()->image('photo.png', 480, 320);

    $response = put(route('universities.photos.update', $university->getRouteKey()), [
        'photo' => $photo
    ]);

    Storage::disk('public')->assertExists('/avatars/'.$photo->hashName());
    $response->assertRedirect(RouteServiceProvider::HOME);
});
