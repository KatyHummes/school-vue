<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\School;
use Faker\Factory as Faker;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $nivelEducacaoECursos = [
            'Médio' => ['Médio', 'Médio Técnico'],
            'Técnico' => ['Técnico em Administração', 'Técnico em Enfermagem', 'Técnico em Informática', 'Técnico em Contabilidade'],
            'Superior' => ['Análise e Desenvolvimento de Sistemas', 'Design Gráfico', 'Design de Jogos', 'Design de Interiores'],
        ];

        foreach (range(1, 100) as $index) {
            $nivelEducacao = $faker->randomElement(['Médio', 'Técnico', 'Superior']);
            $course = $faker->randomElement($nivelEducacaoECursos[$nivelEducacao]);

            School::create([
                'name' => $faker->company,
                'course' => $course,
                'education' => $nivelEducacao,
                'address' => $faker->address,
            ]);
        }
    }
}