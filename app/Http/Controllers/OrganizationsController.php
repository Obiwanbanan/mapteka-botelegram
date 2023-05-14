<?php

namespace App\Http\Controllers;

use App\Handler\Organization\OrganizationHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrganizationsController extends Controller
{
    public function organization()
    {
        return view('organization/organization');
    }

//    public function organization(
//        Request $request,
//        OrganizationHandler $handler
//    ): JsonResponse {
//        return $handler($request);
//    }
}
