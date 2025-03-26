<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GroupService;
use Illuminate\Http\JsonResponse;

class GroupController extends Controller
{
    protected $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    /**
     * Listar todos los grupos
     */
    public function index(): JsonResponse
    {
        $result = $this->groupService->index();

        return $result['success']
            ? response()->json([
                'success' => true,
                'data' => $result['data']
            ])
            : response()->json([
                'success' => false,
                'message' => $result['message']
            ], 500);
    }

    /**
     * Mostrar un grupo específico
     */
    public function show(string $id): JsonResponse
    {
        $result = $this->groupService->show($id);

        return $result['success']
            ? response()->json([
                'success' => true,
                'data' => $result['data']
            ])
            : response()->json([
                'success' => false,
                'error' => 'Group not found',
                'message' => $result['message']
            ], 404);
    }

    /**
     * Crear un nuevo grupo
     */
    public function store(Request $request): JsonResponse
    {
        $result = $this->groupService->store($request->all());

        return $result['success']
            ? response()->json([
                'success' => true,
                'data' => $result['data']
            ], 201)
            : response()->json([
                'success' => false,
                'errors' => $result['message'],
                'message' => 'Validation error'
            ], 422);
    }

    /**
     * Actualizar un grupo
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $result = $this->groupService->update($id, $request->all());

        return $result['success']
            ? response()->json([
                'success' => true,
                'data' => $result['data']
            ])
            : response()->json([
                'success' => false,
                'error' => 'Group not found',
                'message' => $result['message']
            ], 422);
    }

    /**
     * Eliminar un grupo
     */
    public function destroy(string $id): JsonResponse
    {
        $result = $this->groupService->destroy($id);

        return $result['success']
            ? response()->json([
                'success' => true,
            ])
            : response()->json([
                'success' => false,
                'error' => 'Group not found',
                'message' => $result['message']
            ], 404);
    }
}
