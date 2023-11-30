<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classroom;
use App\Models\School;
use Faker\Factory as Faker;

class ClassroomSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $schools = School::all();

        foreach ($schools as $school) {
            foreach (range(1, 3) as $index) {
                Classroom::create([
                    'school_id' => $school->id,
                    'name' => $faker->word,
                    'rotation' => $faker->randomElement(['Manhã', 'Tarde', 'Noite']),
                    'max_students' => $faker->randomNumber(2),
                ]);
            }
        }
    }
}

