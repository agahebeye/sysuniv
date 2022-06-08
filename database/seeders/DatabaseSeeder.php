<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin01@sysuniv.org',
            'password' => 'introuvablex02',
            'role' => UserType::ADMIN
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'univ01@sysuniv.org',
            'password' => 'introuvablex02',
            'role' => UserType::UNIVERSITY
        ]);
    }
}
