<?php

namespace App\Http\Controllers;

use App\Handler\Organization\OrganizationHandler;
use App\Models\Bot;
use App\Models\Organization;
use App\Models\Pharmacies;
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

    public function show($id)
    {
        return view('organization/edit', [
            'organization' => Organization::where('id', $id)->get()->toArray()[0],
            'chatBots' => Bot::all()
        ]);
    }

    public function delete($id)
    {
        Pharmacies::where('organization_id', $id)->delete();
        Organization::where('id', $id)->delete();

        return redirect('organization');
    }

//    public function editOrganization($id)
//    {
//        Pharmacies::where('organization_id', $id)->delete();
//        Organization::where('id', $id)->delete();
//
//        return redirect('organization');
//    }

    public function add(): string
    {
        return view('organization/add', [
            'chatBots' => Bot::all()
        ]);
    }





//    public function organization(
//        Request $request,
//        OrganizationHandler $handler
//    ): JsonResponse {
//        return $handler($request);
//    }
}
