<?php

namespace Database\Seeders;

use App\Models\Institute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstituteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            'Institut de Statistique Appliquée',
            'Institut d’administration et de cartographie foncières',
            'Institut  de Pédagogie Appliquée',
            'Institut Supérieur des Sciences Appliquées',
            'Institut Supérieur de Formation Agricole',
            'Institut Supérieur de Commerce',
            'Institut d’Education Physique et des Sports',
            'Institut de maintenance informatique et réseaux',
            'Institut interfacultaire de statistique'
        ])->each(fn ($name) => Institute::factory()->create(['name' => $name]));
    }
}
