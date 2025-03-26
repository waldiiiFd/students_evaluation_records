<?php

namespace App\Services;

use App\Models\Group;
use Throwable;
use Illuminate\Support\Facades\Validator;

class GroupService
{
    private function validateGroupData(array $data): array
    {
        $validator = Validator::make($data, Group::rules());

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
            $groups = Group::all();
            return [
                'success' => true,
                'data' => $groups
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al recuperar los grupos: ' . $e->getMessage()
            ];
        }
    }

    public function show(string $id): array
    {
        try {
            $group = Group::findOrFail($id);
            return [
                'success' => true,
                'data' => $group
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Grupo no encontrado: ' . $e->getMessage()
            ];
        }
    }

    public function store(array $data): array
    {
        $validationResult = $this->validateGroupData($data);
        if (!$validationResult['success']) {
            return $validationResult;
        }

        try {
            $group = Group::create($data);
            return [
                'success' => true,
                'data' => $group
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al crear el grupo: ' . $e->getMessage()
            ];
        }
    }

    public function update(string $id, array $data): array
    {
        try {
            $group = Group::findOrFail($id);

            $validationResult = $this->validateGroupData($data);
            if (!$validationResult['success']) {
                return $validationResult;
            }

            $updated = $group->update($data);

            if (!$updated) {
                return [
                    'success' => false,
                    'message' => 'No se pudo actualizar el grupo'
                ];
            }

            return [
                'success' => true,
                'data' => $group
            ];
        } catch (Throwable $e) {

            return [
                'success' => false,
                'message' => 'Error al actualizar el grupo: ' . $e->getMessage()
            ];
        }
    }

    public function destroy(string $id): array
    {
        try {
            $group = Group::findOrFail($id);
            $deleted = $group->delete();

            if (!$deleted) {
                return [
                    'success' => false,
                    'message' => 'No se pudo eliminar el grupo'
                ];
            }

            return [
                'success' => true,
                'data' => null
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al eliminar el grupo: ' . $e->getMessage()
            ];
        }
    }
}
