<?php

namespace Database\Seeders;

use App\Models\Evaluation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class EvaluationStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        $evaluations = Evaluation::all();

        foreach ($students as $student) {
            $maxEvals = min(5, $evaluations->count());
            $randomEvaluations = $evaluations->random(rand(3, $maxEvals));

            foreach ($randomEvaluations as $evaluation) {
                DB::table('routes')->insert([
                    'student_id' => $student->id,
                    'evaluation_id' => $evaluation->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
