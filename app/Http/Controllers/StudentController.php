<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\StudentStoreRequest;
use Throwable;
use Exception;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Student::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentStoreRequest $request)
    {
        /*  dd('test'); */

        $student = Student::create($request->validated());
        return response()->json($student);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return response()->json(Student::findOrFail($id));
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'error' => 'Student not found',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentStoreRequest $request, string $id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->update($request->validated());
            return response()->json($student);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'error' => 'Student not found',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();
            return response()->noContent();
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'error' => 'Student not found',
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
