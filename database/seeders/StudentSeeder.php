<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Classroom;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $classrooms = Classroom::all();

        foreach ($classrooms as $classroom) {
            foreach (range(1, 10) as $index) {
                Student::create([
                    'classroom_id' => $classroom->id,
                    'name' => $faker->name,
                    'birth' => $faker->date,
                    'cpf' => $faker->numerify('###########'),
                    'sex' => $faker->randomElement(['Masculino', 'Feminino', 'Outro']),
                    'address' => $faker->address,
                ]);
            }
        }
    }
}
