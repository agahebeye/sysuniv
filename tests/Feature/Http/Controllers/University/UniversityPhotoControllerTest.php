<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\put;

it('can update universities photos', function() {
    Storage::fake('public');

    $this->actingAs($university = User::factory()->university()->create());
    $response = put(route('universities.photos.update', $university->id), [
        'photo' => UploadedFile::fake()->image('photo')
    ]);

    dd($response->json());
});
