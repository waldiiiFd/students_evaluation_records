<?php

namespace App\Http\Controllers;

use App\Services\SubjectService;

class SubjectController extends BaseController
{
    public function __construct(SubjectService $subjectService)
    {
        parent::__construct($subjectService);
    }
}
