<?php

namespace App\Handler;

use App\Models\Organization;
use App\Models\Pharmacies;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class PharmaciesHandler
{
    public function __invoke($request): JsonResponse
    {
        $action = $request->input('action') ?? '';

        $this->add($action, $request);
        $this->remove($action, $request);
        $this->update($action, $request);

        $organizationId = $request->input('organizationId');

        if ($action === 'search') {
            $pharmacies = $this->search($request, $organizationId);
        } else {
            $pharmacies = Pharmacies::where('organization_id', $organizationId)->get();
        }

        $organization = Organization::where('id', $organizationId)->first();


        return response()->json([
            'status' => true,
            'html' => view('ajax/pharmacies', compact('pharmacies', 'organization'))->render()
        ]);
    }

    private function add(
         string $action,
         object $request
    ): void
    {
        if ($action === 'add') {
            $newPharmacy = new Pharmacies();

            $newPharmacy->name = $request->input('name');
            $newPharmacy->address = $request->input('address');
            $newPharmacy->coordinate_X_for_map = $request->input('coordinate_X');
            $newPharmacy->coordinate_Y_for_map = $request->input('coordinate_Y');
            $newPharmacy->organization_id = $request->input('organizationId');

            $newPharmacy->save();
        }
    }


    private function update(
        string $action,
        object $request
    ): void
    {
        if ($action === 'update') {
            $id = $request->input('pharmacyId');
            Pharmacies::where('id', $id)
                ->update(
                    [
                        'name' => $request->input('name'),
                        'address' => $request->input('address'),
                        'coordinate_X_for_map' => $request->input('coordinate_X'),
                        'coordinate_Y_for_map' => $request->input('coordinate_Y'),
                    ]
                );
        }
    }

    private function remove(
        string $action,
        object $request
    ): void
    {
        if ($action === 'remove') {
            $id = $request->input('pharmacyId');
            Pharmacies::where('id', $id)->delete();
        }
    }

    private function search(
        object $request,
        string $organizationId
    ): Collection
    {
        $search = $request->input('search');
        if ($search) {
            $result = Pharmacies::where('organization_id', $organizationId)
                ->where('name', 'LIKE', '%' . $search . '%')
                ->get();
        } else {
            $result = Pharmacies::where('organization_id', $organizationId)->get();
        }
        return $result;
    }
}
