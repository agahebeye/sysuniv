<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'Université Lumière de Bujumbura',
                'email' => 'lumiere@sysuniv.org',
                'photo_url' => 'university-lumiere.png',
            ], [
                'name' => 'Bujumbura International University',
                'email' => 'biu@gmail.com',
                'photo_url' => 'university-buja-international.png'
            ], [
                'name' => 'Université du Burundi',
                'email' => 'duburundi@sysuniv.org',
                'photo_url' => 'university-burundi.jpeg'
            ], [
                'name' => 'Hope Africa University',
                'email' => 'hope-africa@sysuniv.org',
                'photo_url' => 'university-hope-africa.png'
            ], [
                'name' => 'Université des Grands Lacs',
                'email' => 'ugl.univ@gmail.fr',
                'photo_url' => 'university-grands-lacs.png'
            ], [
                'name' => 'Université Sagesse d\'Afrique de Bujumbura',
                'email' => 'usa.bi@gmail.com',
                'photo_url' => 'university-sage-africa.jpeg'
            ], [
                'name' => 'International University of Equator',
                'email' => 'iue.bi@gmail.com',
                'photo_url' => 'university-equator.png'
            ], [
                'name' => "Institut Supérieur d'Ingénieurs et Cadres Techniciens en Génie Informatique, Télécommunications et Technologies Avancées",
                'email' => 'initelematique@sysuniv.org',
                'photo_url' => 'university-sadoc.jpeg'
            ], [
                'name' => 'International Leadership University of Bujumbura',
                'email' => 'ilub.bi@sysuniv.org',
                'photo_url' => 'leardership-university.jpg'
            ]
        ])->each(function ($university) {
            $faker =  \Faker\Factory::create();

            $attributes = [
                'name' => $university['name'],
                'email' => $university['email'],
                'password' => 'introuvablex02',
                'role' => UserType::UNIVERSITY,
                'website' => "https://www.$faker->domainName",
                'address' => $faker->streetAddress(),
            ];

            $university = User::query()->create($attributes);

            $university->photos()->create(['src' => "/storage/avatars/universities/{$university['photo_url']}"]);

            $university->faculties()->attach([]);
            $university->institutes()->attach([]);
            $university->departments()->attach([]);
        });
    }

    /**
     * create the university model
     * @return \App\Models\User
     */
    private function createUniversity($attributes)
    {
    }

    private function createUniversityRelationshipIds(string $class): array
    {
        return app($class)::inRandomOrder()
            ->limit(rand(4, 6))
            ->get()
            ->map(fn ($model) => ['id' => $model->id])
            ->flatten()
            ->toArray();
    }
}
