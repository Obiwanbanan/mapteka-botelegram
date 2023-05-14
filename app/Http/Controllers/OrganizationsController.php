<?php

namespace App\Http\Controllers;

use App\Handler\Organization\OrganizationHandler;
use App\Models\Bot;
use App\Models\Organization;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrganizationsController extends Controller
{
    public function index(): string
    {
        return view('organization/index', [
            'chatBots' => Bot::all(),
            'organizations' => Organization::all()
        ]);
    }

    public function edit($id): string
    {
        /** @var Organization $organization */
        $organization = Organization::where('id', $id)->get();
        dd($organization);
    }

    public function add(): string
    {
        return view('organization/add', [
            'chatBots' => Bot::all()
        ]);
    }

    public function delete()
    {

    }



//    public function organization(
//        Request $request,
//        OrganizationHandler $handler
//    ): JsonResponse {
//        return $handler($request);
//    }
}
