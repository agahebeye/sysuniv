<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Institute;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    public function __construct()
    {
    }
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
                'photo_url' => 'leadership-university.jpg'
            ]
        ])->each(function ($university) {

            $photo_url = 'avatars/universities/' . $university['photo_url'];
            $university = $this->createUniversity($university);
            $university->photo()->create(['src' => $photo_url]);
            
            $university->faculties()->attach(
                $this->createUniversityRelationshipIds(Faculty::class)
            );

            $university->institutes()->attach(
                $this->createUniversityRelationshipIds(Institute::class)
            );

            $university->departments()->attach(
                $this->createUniversityRelationshipIds(Department::class)
            );
        });
    }

    /**
     * create the university model
     * @return \App\Models\User
     */
    private function createUniversity($university)
    {
        $attributes = [
            'name' => $university['name'],
            'email' => $university['email'],
            'password' => 'secret',
            'role' => UserType::UNIVERSITY,
            'website' => 'https://www.' . fake()->domainName(),
            'address' => fake()->streetAddress(),
        ];

        return User::query()->create($attributes);;
    }

    /**
     * @param string $class
     * 
     * @return array
     */
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
