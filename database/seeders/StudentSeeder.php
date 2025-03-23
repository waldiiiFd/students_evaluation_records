<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Group;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            ['fullname' => 'Juan Pérez'],
            ['fullname' => 'María González'],
            ['fullname' => 'Carlos Rodríguez'],
            ['fullname' => 'Ana Martínez'],
            ['fullname' => 'Pedro López'],
            ['fullname' => 'Laura García'],
            ['fullname' => 'Miguel Fernández'],
            ['fullname' => 'Sofía Torres'],
            ['fullname' => 'David Ramírez'],
            ['fullname' => 'Elena Sánchez'],
            ['fullname' => 'Javier Díaz'],
            ['fullname' => 'Carmen Ruiz'],
            ['fullname' => 'Roberto Gómez'],
            ['fullname' => 'Isabel Herrera'],
            ['fullname' => 'Fernando Castro'],
        ];

        $groups = Group::all();

        foreach ($students as $studentData) {
            $randomGroup = $groups->random();

            Student::create([
                'fullname' => $studentData['fullname'],
                'group_id' => $randomGroup->id,
            ]);
        }
    }
}
