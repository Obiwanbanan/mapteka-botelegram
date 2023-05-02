<?php

namespace App\Http\Controllers;

use App\Handler\Organization\OrganizationHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrganizationsController extends Controller
{
    public function index(): string
    {
        return view('organizations/index');
    }

    public function organization(
        Request $request,
        OrganizationHandler $handler
    ): JsonResponse {
        return $handler($request);
    }
}
