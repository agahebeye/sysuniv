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
        \App\Models\User::factory()->admin()->create([
            'email' => 'admin@sysuniv.org',
            'password' => 'introuvablex02'
        ]);

        $this->call([
            UniversitySeeder::class,
            FacultySeeder::class,
            InstituteSeeder::class,
            DepartmentSeeder::class,
        ]);
    }
}
