<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StudentService;
use Illuminate\Http\JsonResponse;


class StudentController extends Controller
{

    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->studentService->index();

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = $this->studentService->store($request->all());

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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = $this->studentService->show($id);

        return $result['success']
            ? response()->json([
                'success' => true,
                'data' => $result['data']
            ])
            : response()->json([
                'success' => false,
                'error' => 'Student not found',
                'message' => $result['message']
            ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = $this->studentService->update($id, $request->all());

        return $result['success']
            ? response()->json([
                'success' => true,
                'data' => $result['data']
            ])
            : response()->json([
                'success' => false,
                'error' => 'Student not found',
                'message' => $result['message']
            ], 422);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->studentService->destroy($id);

        return $result['success']
            ? response()->json([
                'success' => true,
            ])
            : response()->json([
                'success' => false,
                'error' => 'Student not found',
                'message' => $result['message']
            ], 404);
    }
}
