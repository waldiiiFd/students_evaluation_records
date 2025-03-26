<?php

namespace App\Services;

use App\Models\Student;
use Throwable;
use Illuminate\Support\Facades\Validator;

class StudentService
{
    private function validateStudentData(array $data): array
    {
        $validator = Validator::make($data, Student::rules());

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => $validator->errors()->first()
            ];
        }

        return ['success' => true];
    }

    public function index(): array
    {
        try {
            $students = Student::all();
            return [
                'success' => true,
                'data' => $students
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al recuperar los estudiantes: ' . $e->getMessage()
            ];
        }
    }

    public function show(string $id): array
    {
        try {
            $group = Student::findOrFail($id);
            return [
                'success' => true,
                'data' => $group
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Estudiante no encontrado: ' . $e->getMessage()
            ];
        }
    }

    public function store(array $data): array
    {
        $validationResult = $this->validateStudentData($data);
        if (!$validationResult['success']) {
            return $validationResult;
        }

        try {
            $student = Student::create($data);
            return [
                'success' => true,
                'data' => $student
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al crear el estudiante: ' . $e->getMessage()
            ];
        }
    }

    public function update(string $id, array $data): array
    {
        try {
            $student = Student::findOrFail($id);

            $validationResult = $this->validateStudentData($data);
            if (!$validationResult['success']) {
                return $validationResult;
            }

            $updated = $student->update($data);

            if (!$updated) {
                return [
                    'success' => false,
                    'message' => 'No se pudo actualizar el estudiante'
                ];
            }

            return [
                'success' => true,
                'data' => $student
            ];
        } catch (Throwable $e) {

            return [
                'success' => false,
                'message' => 'Error al actualizar el estudiante: ' . $e->getMessage()
            ];
        }
    }

    public function destroy(string $id): array
    {
        try {
            $student = Student::findOrFail($id);
            $deleted = $student->delete();

            if (!$deleted) {
                return [
                    'success' => false,
                    'message' => 'No se pudo eliminar el estudiante'
                ];
            }

            return [
                'success' => true,
                'data' => null
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al eliminar el estudiante: ' . $e->getMessage()
            ];
        }
    }
}
