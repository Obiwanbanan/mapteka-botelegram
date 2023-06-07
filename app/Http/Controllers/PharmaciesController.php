<?php

namespace App\Http\Controllers;

use App\Handler\PharmaciesHandler;
use App\Models\City;
use App\Models\Organization;
use App\Models\Pharmacies;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;



class PharmaciesController extends Controller
{
//    public function index(): View
//    {
//        return view('organization/index', [
//            'organizations' => Organization::paginate(6)
//        ]);
//    }

//    public function remove(
//        Request $request,
//        OrganizationHandler $organizationHandler,
//    ): JsonResponse|RedirectResponse
//    {
//        return response()->json($organizationHandler->remove($request));
//    }
//
//    public function update(
//        $id,
//        Request $request,
//        OrganizationHandler $organizationHandler,
//    ): View|JsonResponse
//    {
//        if ($request->isMethod('post')) {
//            return response()->json($organizationHandler->update($request));
//        }
//
//        return view('organization/edit', [
//            'organization' => Organization::find($id),
//            'pharmacies' => Pharmacies::where('organization_id', $id)->get(),
//            'chatBots' => Bot::all()
//        ]);
//    }

    public function add(
        Request $request,
        PharmaciesHandler $pharmaciesHandler,
    ): View|JsonResponse
    {
        if ($request->isMethod('post')) {
            return response()->json($pharmaciesHandler->add($request));
        }

        return view('pharmacy/add', [
            'organizations' => Organization::all(),
            'cities'=> City::select('id', 'name')->get(),
        ]);
    }

    public function update(
        Request $request,
        PharmaciesHandler $pharmaciesHandler,
    ): View|JsonResponse
    {
        if ($request->isMethod('post')) {
            return response()->json($pharmaciesHandler->update($request));
        }

        return view('pharmacy/edit', [
            'organizations' => Organization::all(),
            'cities'=> City::select('id', 'name')->get(),
            'pharmacy'=> Pharmacies::where('id', $request->route('id'))->get()->first(),
        ]);
    }

    public function remove(
        Request $request,
        PharmaciesHandler $pharmaciesHandler,
    ): JsonResponse
    {
        return response()->json($pharmaciesHandler->remove($request));
    }
}
