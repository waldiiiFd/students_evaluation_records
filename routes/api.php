<?php

use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 */

 Route::resource('/group', GroupController::class); // GET, POST, PUT, DELETE
 Route::resource('/student', StudentController::class); // GET, POST, PUT, DELETE
 Route::resource('/subject', SubjectController::class); // GET, POST, PUT, DELETE
 Route::resource('/evaluation', EvaluationController::class); // GET, POST, PUT, DELETE
 Route::resource('/evaluation_student', RouteController::class); // GET, POST, PUT, DELETE

