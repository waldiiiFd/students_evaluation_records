<?php

namespace App\Services;

use App\Models\Evaluation;
use Throwable;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class EvaluationService
{
    private function validateEvaluationData(array $data): array
    {
        $validator = Validator::make($data, Evaluation::rules());

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => $validator->errors()->first()
            ];
        }

        return ['success' => true];
    }

    private function processEvaluationData(array $data): array
    {
        $evaluationDate = Carbon::parse($data['evaluation_date']);
        $today = Carbon::now()->startOfDay();

        if ($evaluationDate->greaterThan($today)) {
            $data['grade'] = null;
        }

        return $data;
    }

    public function index(): array
    {
        try {
            $evaluations = Evaluation::all();
            return [
                'success' => true,
                'data' => $evaluations
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al recuperar las evaluaciones: ' . $e->getMessage()
            ];
        }
    }

    public function show(string $id): array
    {
        try {
            $evaluation = Evaluation::findOrFail($id);
            return [
                'success' => true,
                'data' => $evaluation
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Evaluación no encontrada: ' . $e->getMessage()
            ];
        }
    }

    public function store(array $data): array
    {
        $validationResult = $this->validateEvaluationData($data);
        if (!$validationResult['success']) {
            return $validationResult;
        }

        try {
            $processedData = $this->processEvaluationData($data);

            $evaluation = Evaluation::create($processedData);
            return [
                'success' => true,
                'data' => $evaluation
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al crear la evaluación: ' . $e->getMessage()
            ];
        }
    }

    public function update(string $id, array $data): array
    {
        try {
            $evaluation = Evaluation::findOrFail($id);

            $validationResult = $this->validateEvaluationData($data);
            if (!$validationResult['success']) {
                return $validationResult;
            }

            $processedData = $this->processEvaluationData($data);

            $updated = $evaluation->update($processedData);

            if (!$updated) {
                return [
                    'success' => false,
                    'message' => 'No se pudo actualizar la evaluación'
                ];
            }

            return [
                'success' => true,
                'data' => $evaluation
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al actualizar la evaluación: ' . $e->getMessage()
            ];
        }
    }

    public function destroy(string $id): array
    {
        try {
            $evaluation = Evaluation::findOrFail($id);
            $deleted = $evaluation->delete();

            if (!$deleted) {
                return [
                    'success' => false,
                    'message' => 'No se pudo eliminar la evaluación'
                ];
            }

            return [
                'success' => true,
                'data' => null
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al eliminar la evaluación: ' . $e->getMessage()
            ];
        }
    }
}
