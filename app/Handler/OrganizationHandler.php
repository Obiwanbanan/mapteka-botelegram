<?php

namespace App\Handler;

use App\Models\Organization;
use App\Models\Pharmacies;
use Illuminate\Http\JsonResponse;

class OrganizationHandler
{
    public function __invoke($request): JsonResponse
    {

//        try {
        $action = $request->input('action') ?? '';

        $this->add($action, $request);
        $this->remove($action, $request);

        $organizations = Organization::with('bot')->paginate(10);

        $page = $request->input('page');

        return response()->json([
            'status' => true,
            'html' => view('ajax/' . $page, compact('page', 'organizations'))->render()
        ]);

//        } catch (\Exception $exception) {
//
//            return response()->json([
//                'status' => false,
//            ]);
//        }
    }

    private function remove($action, $request): void
    {
        if ($action === 'remove') {
            $organizationId = $request->input('id');
            Pharmacies::where('organization_id', $organizationId)->delete();
            Organization::where('id', $organizationId)->delete();
        }
    }

    private function add($action, $request): void
    {
        if ($action === 'add') {
            $newOrganization = new Organization();

            $newOrganization->name = $request->input('organizationName');
            $newOrganization->INN = $request->input('organizationINN');
            $newOrganization->bot_id = 4;

            $newOrganization->save();

        }
    }
}
