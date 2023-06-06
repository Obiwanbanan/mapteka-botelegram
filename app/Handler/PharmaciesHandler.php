<?php

namespace App\Handler;

use App\Models\Bot;
use App\Models\Organization;
use App\Models\Pharmacies;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class PharmaciesHandler
{
//    public function __invoke($request): JsonResponse
//    {
//        $action = $request->input('action') ?? '';
//
//        $this->add($action, $request);
//        $this->remove($action, $request);
//        $this->update($action, $request);
//
//        $organizationId = $request->input('organizationId');
//
//        if ($action === 'search') {
//            $pharmacies = $this->search($request, $organizationId);
//        } else {
//            $pharmacies = Pharmacies::where('organization_id', $organizationId)->get();
//        }
//
//        $organization = Organization::where('id', $organizationId)->first();
//        $chatBots = Bot::all();
//
//        return response()->json([
//            'status' => true,
//            'html' => view('ajax/pharmacies', compact('pharmacies', 'organization', 'chatBots'))->render()
//        ]);
//    }

    public function add(
        object $request
    ): array
    {
        $validated = $this->validated($request);

        if (!$validated['status']) {
            return $validated;
        }

        try {
            $newPharmacy = new Pharmacies();
            $newPharmacy->name = $request->input('name');
            $newPharmacy->address = $request->input('address');
            $newPharmacy->city_id = $request->input('selected-city');
            $newPharmacy->map_url = $request->input('map');
            $newPharmacy->organization_id = $request->input('selected-organization');

            $newPharmacy->save();
            return [
                'status' => true,
                'url' => route('organization') . '/' . $request->input('selected-organization') . '/update',
            ];
        } catch (\Exception $e) {

            return [
                'status' => false,
                'message' => 'что-то пошло не так!',
            ];
        }

    }


//    private function update(
//        string $action,
//        object $request
//    ): void
//    {
//        if ($action === 'update') {
//            $id = $request->input('pharmacyId');
//            Pharmacies::where('id', $id)
//                ->update(
//                    [
//                        'name' => $request->input('name'),
//                        'address' => $request->input('address'),
//                        'latitude' => $request->input('coordinate_X'),
//                        'longitude' => $request->input('coordinate_Y'),
//                    ]
//                );
//        }
//    }

    public function remove(
        object $request
    ): array
    {
        try {
            Pharmacies::where('id', $request->input('id'))->delete();

            return [
                'status' => true,
                'message' => 'Аптека успешно Удалена',

            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Что-то пошло не так!'
            ];
        }
    }
//
//    private function search(
//        object $request,
//        string $organizationId
//    ): Collection
//    {
//        $search = $request->input('search');
//        if ($search) {
//            $result = Pharmacies::where('organization_id', $organizationId)
//                ->where('name', 'LIKE', '%' . $search . '%')
//                ->get();
//        } else {
//            $result = Pharmacies::where('organization_id', $organizationId)->get();
//        }
//        return $result;
//    }

    private function validated(object $request): array
    {

        if (empty($request->input('name'))) {
            return [
                'status' => false,
                'message' => 'Имя не может быть пустым!'
            ];
        }

        if (empty($request->input('address'))) {
            return [
                'status' => false,
                'message' => 'Адрес не может быть пустым!'
            ];
        }

        if (empty($request->input('map'))) {
            return [
                'status' => false,
                'message' => 'Ссылка не может быть пустой!'
            ];
        }

        return [
            'status' => true,
        ];
    }
}
