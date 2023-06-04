<?php

namespace App\Http\Controllers;

use App\Handler\Organization\OrganizationHandler;
use App\Models\Bot;
use App\Models\Organization;
use App\Models\Pharmacies;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class OrganizationsController extends Controller
{
    public function index(): View
    {
        return view('organization/index', [
            'organizations' => Organization::paginate(6)
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

    public function search() {
        dd(1);
    }
}
