<?php

use App\Enums\UserType;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\{assertDatabaseHas, get, post};

beforeEach(fn () => $this->actingAs(User::factory()->admin()->create()));

it('can see employees', function () {
    $reponse = get('/employees');
    $reponse
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) =>
            $page->component('employees/index')
                ->count('employees', 0)
        );
});

it('can create employees', function () {
    $response = get(route('employees.create'))
        ->assertOk()
        ->assertInertia(fn ($page) => $page->component('employees/create'));
});

it('can store employees', function () {
    $data = User::factory()->raw();
    $response = post(route('employees.store', [
        ...$data, 'password_confirmation' => 'secretsecret', 'role' => UserType::EMPLOYEE->value
    ]));

    $response->assertRedirect(RouteServiceProvider::HOME);
    assertDatabaseHas('users', [
        'name' => $data['name'],
        'role' => UserType::EMPLOYEE->value
    ]);
});
