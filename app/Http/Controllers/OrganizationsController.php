<?php

namespace App\Http\Controllers;

use App\Handler\OrganizationHandler;
use App\Models\Bot;
use App\Models\Organization;
use App\Models\Pharmacies;
use App\Service\Pagination;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class OrganizationsController extends Controller
{
    public function index(
        Pagination $pagination,
    ): View {
        return view('organization/index', $pagination->paginationWithParam(Organization::class));
    }

    public function remove(
        Request $request,
        OrganizationHandler $organizationHandler,
    ): JsonResponse|RedirectResponse
    {
        return response()->json($organizationHandler->remove($request));
    }

    public function update(
        $id,
        Request $request,
        OrganizationHandler $organizationHandler,
        Pagination $pagination,
    ): View|JsonResponse {
        if ($request->isMethod('post')) {
           return response()->json($organizationHandler->update($request));
        }

        return view('organization/edit', array_merge([
            'organization' => Organization::find($id),
            'chatBots' => Bot::all(),
        ],
        $pagination->paginationWithParam(
            null,
            Pharmacies::getPharmaciesByOrganizationQuery($id)
        )
        ));
    }

    public function add(
        Request $request,
        OrganizationHandler $organizationHandler,
    ): View|JsonResponse
    {
        if ($request->isMethod('post')) {
            return response()->json($organizationHandler->add($request));
        }

        return view('organization/add', [
            'chatBots' => Bot::all()
        ]);
    }

    public function paginationWithParam(
        Request    $request,
        Pagination $pagination,
    ): JsonResponse {
        $result = view('organization/pagination', $pagination->paginationWithParam(
            null,
            Organization::getSearchOrganizationQuery($request->get('search')),
            $request->get('page'),
        ));

        return response()->json([
            'result' => $result->render(),
        ]);
    }
}
