<?php

namespace App\Http\Controllers;

use App\Services\RouteService;
use Illuminate\Http\Request;

class RouteController extends BaseController
{
    public function __construct(RouteService $routeService)
    {
        parent::__construct($routeService);
    }
}
