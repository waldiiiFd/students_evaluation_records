<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Throwable;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{

    protected function groupModelValidation($request)
    {
        $validator = Validator::make($request->all(), Group::rules());
        if ($validator->fails()) {
            return [
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation error'
            ];
        }
        return ['success' => true];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Group::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = $this->groupModelValidation($request);
        if (!$result['success']) {
            return response()->json($result, 422);
        }
        $model = Group::create($request->all());
        if (!$model) {
            return response()->json([
                'success' => false,
                'message' => 'Group not created'
            ], 500);
        }
        return response()->json($model);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return response()->json(Group::findOrFail($id));
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'error' => 'Group not found',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $group = Group::findOrFail($id);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'error' => 'Group not found',
                'message' => $e->getMessage()
            ], 404);
        }

        $result = $this->groupModelValidation($request);

        if (!$result['success']) {
            return response()->json($result, 422);
        }

        $updated = $group->update($request->all());

        if (!$updated) {
            return response()->json([
                'success' => false,
                'message' => 'Group not updated'
            ], 500);
        }

        return response()->json($group);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $group = Group::findOrFail($id);
            $deleted = $group->delete();

            if (!$deleted) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete group'
                ], 500);
            }

            return response()->noContent();
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'error' => 'Group not found',
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
