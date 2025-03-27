<?php

namespace App\Services;

use App\Models\Route;
use Throwable;
use Illuminate\Support\Facades\Validator;

class RouteService
{
    private function validateRouteData(array $data): array
    {
        $validator = Validator::make($data, Route::rules());

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
            $routes = Route::with(['student', 'evaluation'])->get();
            return [
                'success' => true,
                'data' => $routes
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al recuperar las rutas: ' . $e->getMessage()
            ];
        }
    }

    public function show(string $id): array
    {
        try {
            $route = Route::with(['student', 'evaluation'])->findOrFail($id);
            return [
                'success' => true,
                'data' => $route
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Ruta no encontrada: ' . $e->getMessage()
            ];
        }
    }

    public function store(array $data): array
    {
        $validationResult = $this->validateRouteData($data);
        if (!$validationResult['success']) {
            return $validationResult;
        }

        try {
            $route = Route::create($data);
            return [
                'success' => true,
                'data' => $route
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al crear la ruta: ' . $e->getMessage()
            ];
        }
    }

    public function destroy(string $id): array
    {
        try {
            $route = Route::findOrFail($id);
            $deleted = $route->delete();

            if (!$deleted) {
                return [
                    'success' => false,
                    'message' => 'No se pudo eliminar la ruta'
                ];
            }

            return [
                'success' => true,
                'data' => null
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al eliminar la ruta: ' . $e->getMessage()
            ];
        }
    }

    public function update(string $id, array $data): array
    {
        try {
            $route = Route::findOrFail($id);

            $validationResult = $this->validateRouteData($data);
            if (!$validationResult['success']) {
                return $validationResult;
            }

            $updated = $route->update($data);

            if (!$updated) {
                return [
                    'success' => false,
                    'message' => 'No se pudo actualizar la ruta'
                ];
            }

            return [
                'success' => true,
                'data' => $route
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => 'Error al actualizar la ruta: ' . $e->getMessage()
            ];
        }
    }
}
