<?php

namespace App\Services;

use App\Models\Evaluation;
use Carbon\Carbon;
use Throwable;

class EvaluationService extends BaseService
{
    /**
     * The model class associated with this service
     *
     * @var string
     */
    protected $modelClass = Evaluation::class;

    /**
     * Process evaluation data before saving
     *
     * @param array $data
     * @return array
     */
    private function processEvaluationData(array $data): array
    {
        $evaluationDate = Carbon::parse($data['evaluation_date']);
        $today = Carbon::now()->startOfDay();

        if ($evaluationDate->greaterThan($today)) {
            $data['grade'] = null;
        }

        return $data;
    }

    /**
     * Override the store method to include data processing
     *
     * @param array $data
     * @return array
     */
    public function store(array $data): array
    {
        $validationResult = $this->validateData($data);
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

    /**
     * Override the update method to include data processing
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function update(string $id, array $data): array
    {
        try {
            $evaluation = Evaluation::findOrFail($id);

            $validationResult = $this->validateData($data);
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
}

