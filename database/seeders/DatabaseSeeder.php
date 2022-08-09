<?php

namespace Database\Seeders;

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
            'password' => 'secret'
        ]);

          \App\Models\User::factory()->employee()->create([
            'email' => 'ministere@sysuniv.org',
            'password' => 'secret'
        ]);

        $this->call([
            FacultySeeder::class,
            InstituteSeeder::class,
            DepartmentSeeder::class,
            UniversitySeeder::class,
            StudentSeeder::class
        ]);
    }
}
