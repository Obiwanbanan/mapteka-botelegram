<?php

namespace App\Http\Controllers;

use App\Handler\Organization\OrganizationHandler;
use App\Http\Requests\OrganizationsRequest;
use App\Models\Bot;
use App\Models\Organization;
use App\Models\Pharmacies;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrganizationsController extends Controller
{
    public function index(): View
    {
        return view('organization/index', [
            'organizations' => Organization::paginate(6)
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

    public function edit($id, OrganizationsRequest $request)
    {

        Organization::where('id', $id)
            ->update(
                [
                    'name' => $request->input('name'),
                    'INN' => $request->input('INN'),
                    'bot_id' => $request->input('botId'),
                ]
            );

        return redirect('organization/' .$id)->with('success', 'Организация успешно обновлена!');

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





//    public function organization(
//        Request $request,
//        OrganizationHandler $handler
//    ): JsonResponse {
//        return $handler($request);
//    }
}
