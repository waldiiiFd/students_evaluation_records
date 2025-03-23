<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ['name' => 'Matemáticas'],
            ['name' => 'Física'],
            ['name' => 'Química'],
            ['name' => 'Historia'],
            ['name' => 'Literatura'],
            ['name' => 'Inglés'],
            ['name' => 'Informática'],
            ['name' => 'Biología'],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
