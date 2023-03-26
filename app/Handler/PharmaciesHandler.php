<?php

namespace App\Handler;

use App\Models\Organization;
use App\Models\Pharmacies;
use Illuminate\Http\JsonResponse;

class PharmaciesHandler
{
    public function __invoke($request): JsonResponse
    {
        $action = $request->input('action');
        $this->add($action, $request);
        $this->remove($action, $request);
        $this->update($action, $request);

        $organizationId = $request->input('organizationId');
        $pharmacies = Pharmacies::where('organization_id', $organizationId)->get();
        $organization = Organization::where('id', $organizationId)->first();

        return response()->json([
            'status' => true,
            'html' => view('ajax/pharmacies', compact('pharmacies', 'organization'))->render()
        ]);

    }

    private function remove($action, $request) {
        if ($action === 'remove') {
            $id = $request->input('pharmacyId');
            Pharmacies::where('id', $id)->delete();
        }
    }

    private function update($action, $request) {
        if ($action === 'update') {
            $id = $request->input('pharmacyId');
            Pharmacies::where('id',$id)
                ->update(
                    [
                        'name'=> $request->input('name'),
                        'address'=> $request->input('address'),
                        'coordinate_X_for_map'=> $request->input('coordinate_X'),
                        'coordinate_Y_for_map'=> $request->input('coordinate_Y'),
                    ]
                );
        }
    }

    private function add($action, $request): void
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
}
