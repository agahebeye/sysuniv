<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            'Département d\'informatique',
            'Génie logiciel',
            'Sécurité informatique',
            'Maintenance de Réseau',
            'Département d\'histoire du droit',
            'Département des sciences économiques et administratives'
        ])->each(fn ($name) => Department::factory()->create(['name' => $name]));
    }
}
