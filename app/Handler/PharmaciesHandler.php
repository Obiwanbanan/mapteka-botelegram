<?php

namespace App\Handler;

use App\Models\Organization;
use App\Models\Pharmacies;
use Illuminate\Http\JsonResponse;

class PharmaciesHandler
{
    public function __invoke($request): JsonResponse
    {


//        $this->remove($action, $request);

        $organizationId = $request->input('id');
        $pharmacies = Pharmacies::where('organization_id', $organizationId)->get();
        $organization = Organization::where('id', $organizationId)->first();
        return response()->json([
            'status' => true,
            'html' => view('ajax/pharmacies', compact('pharmacies', 'organization'))->render()
        ]);

    }

    private function remove($action, $request) {
        dd('qwe');
        Organization::where('id', 1)->delete();

    }
}
