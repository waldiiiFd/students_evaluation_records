<?php

namespace App\Services;

use App\Models\Subject;
use Throwable;
use Illuminate\Support\Facades\Validator;

class SubjectService
{
    private function validateSubjectData(array $data): array
    {
        $validator = Validator::make($data, Subject::rules());

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
            $subjects = Subject::all();
            return [
                'success' => true,
                'data' => $subjects
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al recuperar las materias: ' . $e->getMessage()
            ];
        }
    }

    public function show(string $id): array
    {
        try {
            $subject = Subject::findOrFail($id);
            return [
                'success' => true,
                'data' => $subject
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Materia no encontrada: ' . $e->getMessage()
            ];
        }
    }

    public function store(array $data): array
    {
        $validationResult = $this->validateSubjectData($data);
        if (!$validationResult['success']) {
            return $validationResult;
        }

        try {
            $subject = Subject::create($data);
            return [
                'success' => true,
                'data' => $subject
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al crear la materia: ' . $e->getMessage()
            ];
        }
    }

    public function update(string $id, array $data): array
    {
        try {
            $subject = Subject::findOrFail($id);

            $validationResult = $this->validateSubjectData($data);
            if (!$validationResult['success']) {
                return $validationResult;
            }

            $updated = $subject->update($data);

            if (!$updated) {
                return [
                    'success' => false,
                    'message' => 'No se pudo actualizar la materia'
                ];
            }

            return [
                'success' => true,
                'data' => $subject
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al actualizar la materia: ' . $e->getMessage()
            ];
        }
    }

    public function destroy(string $id): array
    {
        try {
            $subject = Subject::findOrFail($id);
            $deleted = $subject->delete();

            if (!$deleted) {
                return [
                    'success' => false,
                    'message' => 'No se pudo eliminar la materia'
                ];
            }

            return [
                'success' => true,
                'data' => null
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al eliminar la materia: ' . $e->getMessage()
            ];
        }
    }
}
