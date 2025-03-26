<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 */

 Route::resource('/group', GroupController::class); // GET, POST, PUT, DELETE
 Route::resource('/student', StudentController::class); // GET, POST, PUT, DELETE

