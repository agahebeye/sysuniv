<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\put;

it('can update universities photos', function() {
    Storage::fake('public');

    $this->actingAs($university = User::factory()->university()->create());
    $photo = UploadedFile::fake()->image('photo.png', 480, 320);

    $response = put(route('universities.photos.update', $university->id), [
        'photo' => $photo
    ]);

    Storage::disk('public')->assertExists('/avatars/'.$photo->hashName());
});
