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
        $dataPagination = $pagination->paginationWithParam(Organization::class);

        return view('organization/index', [
            'organizations' => $dataPagination['result'],
            'totalPage' => $dataPagination['totalPage'],
            'page' => $dataPagination['page'],
            'total' => $dataPagination['total'],
        ]);
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
    ): View|JsonResponse
    {
        if ($request->isMethod('post')) {
           return response()->json($organizationHandler->update($request));
        }

        return view('organization/edit', [
            'organization' => Organization::find($id),
            'pharmacies' => Pharmacies::where('organization_id', $id)->get(),
            'chatBots' => Bot::all()
        ]);
    }

    public function add(
        Request $request,
        OrganizationHandler $organizationHandler,
    ): View|JsonResponse
    {
        if ($request->isMethod('post')) {
            $handelAdd = $organizationHandler->add($request);

            if (!$handelAdd['status']) {
                return response()->json($handelAdd);
            }

            return response()->json([
                'status' => true,
                'url' => route('chat-bots'),
            ]);
        }

        return view('organization/add', [
            'chatBots' => Bot::all()
        ]);
    }

    public function paginationWithParam(
        Request    $request,
        Pagination $pagination,
    ): JsonResponse {
        $dataPagination = $pagination->paginationWithParam(
            Organization::class,
            $request->get('page'),
            6,
            [
                'search' => $request->get('search')
            ]
        );

        $result = view('organization/pagination', [
            'organizations' => $dataPagination['result'],
            'totalPage' => $dataPagination['totalPage'],
            'page' => $dataPagination['page'],
            'total' => $dataPagination['total'],
        ]);

        return response()->json([
            'result' => $result->render(),
        ]);
    }
}
