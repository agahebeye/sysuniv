<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->university()->create(['name' => 'Université du lac', 'email' => 'dulac@sysuniv.org', 'password' => 'introuvablex02']);
        \App\Models\User::factory()->university()->create(['name' => 'Université Lumiere', 'email' => 'lumiere@sysuniv.org', 'password' => 'introuvablex02']);
        \App\Models\User::factory()->university()->create(['name' => 'Université sagesse d\'afrique', 'email' => 'usa.bi@sysuniv.org', 'password' => 'introuvablex02']);

    }
}
