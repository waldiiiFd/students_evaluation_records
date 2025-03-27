<?php

namespace App\Http\Controllers;

use App\Services\EvaluationService;
use App\Services\Service;

class EvaluationController extends BaseController
{
    public function __construct(EvaluationService $evaluationService)
    {
        parent::__construct($evaluationService);
    }
}
