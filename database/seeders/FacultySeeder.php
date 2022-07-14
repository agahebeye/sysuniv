<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            'Faculté de Droit, Sciences Politiques et Relations Internationales',
            'Faculté de Psychologie et Sciences de l’Education',
            'Faculté des Sciences de l’Ingénieur',
            'Faculté des Lettres et Sciences Humaines',
            'Faculté de Médecine',
            'Faculté des Sciences',
            'Faculté des Sciences Economiques et de Gestion',
            'Faculté d’Agronomie et Bio-Ingénierie',
        ])->each(fn ($name) => Faculty::factory()->create(['name' => $name]));
    }
}
