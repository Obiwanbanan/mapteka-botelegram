<?php

namespace App\Http\Controllers;

use App\Handler\Organization\OrganizationHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrganizationsController extends Controller
{
    public function index(): string
    {
        return view('home');
    }

    public function organization(
        Request $request,
        OrganizationHandler $handler
    ): JsonResponse {
        return $handler($request);
    }
}
