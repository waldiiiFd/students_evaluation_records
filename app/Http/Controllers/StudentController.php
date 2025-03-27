<?php

namespace App\Http\Controllers;

use App\Services\StudentService;

class StudentController extends BaseController
{
    public function __construct(StudentService $studentService)
    {
        parent::__construct($studentService);
    }
}
