<?php

namespace App\Handler;

use App\Models\Organization;
use App\Models\Pharmacies;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class OrganizationHandler
{
    public function __invoke($request): JsonResponse
    {

//        try {
        $action = $request->input('action') ?? '';

        $this->add($action, $request);
        $this->remove($action, $request);

        if ($action === 'search') {
            $organizations = $this->search($request);
        } else {
            $organizations = Organization::with('bot')->get();
        }
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
    private function add(
        string $action,
        object $request
    ): void
    {
        if ($action === 'add') {
            $newOrganization = new Organization();

            $newOrganization->name = $request->input('organizationName');
            $newOrganization->INN = $request->input('organizationINN');
            $newOrganization->bot_id = 4;

            $newOrganization->save();

        }
    }

    private function remove(
        string $action,
        object $request
    ): void
    {
        if ($action === 'remove') {
            $organizationId = $request->input('id');
            Pharmacies::where('organization_id', $organizationId)->delete();
            Organization::where('id', $organizationId)->delete();
        }
    }

    private function search(
        object $request
    ): Collection
    {
        $search = $request->input('search');
        if ($search) {
            $result = Organization::where('name', 'LIKE', '%' . $search . '%')
                ->with('bot')
                ->get();
        } else {
            $result = Organization::with('bot')->get();
        }
        return $result;
    }
}
