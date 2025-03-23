<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;
use Illuminate\Support\Carbon;
use App\Models\Evaluation;
class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Examen parcial', 'Examen final', 'Trabajo práctico', 'Exposición', 'Participación'];
        $subjects = Subject::all();

        foreach ($subjects as $subject) {

            $evaluationCount = rand(3, 5);

            for ($i = 0; $i < $evaluationCount; $i++) {
                Evaluation::create([
                    'type' => $types[array_rand($types)],
                    'grade' => rand(2, 5),
                    'evaluation_date' => Carbon::now()->subDays(rand(1, 60))->toDateString(),
                    'subject_id' => $subject->id,
                ]);
            }
        }
    }
}
