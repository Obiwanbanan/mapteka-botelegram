<?php

namespace App\Http\Controllers;

use App\Handler\OrganizationHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class OrganizationsController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function organization(
        Request             $request,
        OrganizationHandler $handler
    ): JsonResponse
    {
        return $handler($request);
    }
}
