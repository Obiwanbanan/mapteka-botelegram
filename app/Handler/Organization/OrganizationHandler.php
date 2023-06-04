<?php

namespace App\Handler\Organization;

use App\Models\Organization;
use App\Models\Pharmacies;
use Illuminate\Http\Request;

class OrganizationHandler
{


//    public function add(): void
//    {
//        $organization = new Organization();
//        $organization->name = $this->organizationName;
//        $organization->INN = $this->organizationINN;
//        $organization->bot_id = $this->botId;
//        $organization->save();
//    }

    public function update(
        Request $request
    ): array
    {
        $validated = $this->validated($request);

        if (!$validated['status']) {
            return $validated;
        }

        try {
            Organization::where('id', $request->input('id'))
                ->update(
                    [
                        'name' => $request->input('name'),
                        'INN' => $request->input('INN'),
                        'bot_id' => $request->input('botId'),
                    ]
                );

            return [
                'status' => true,
                'message' => 'Организация успешно отредактирована',
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Что-то пошло не так!'
            ];
        }

    }

    public function remove(
        Request $request
    ): array
    {
        try {
            Pharmacies::where('organization_id', $request->input('id'))->delete();
            Organization::where('id', $request->input('id'))->delete();

            return [
                'status' => true,
                'message' => 'Организация успешно отредактирована',
                'url' => route('organization')
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Что-то пошло не так!'
            ];
        }
    }

//    private function getOrganizationAfterSearch(): Collection
//    {
//        return Organization::where(function ($query) {
//            $query->where('name', 'LIKE', '%' . $this->search . '%')
//                ->orWhere('INN', 'LIKE', '%' . $this->search . '%');
//        })
//            ->with('bot')
//            ->get();
//    }

//    private function getChatBots(): Collection
//    {
//        return Bot::all();
//    }

//    private function getOrganizationWithBot(): Collection
//    {
//        return Organization::with('bot')->get();
//    }

    private function validated(object $request): array
    {
        if (empty($request->input('name'))) {
            return [
                'status' => false,
                'message' => 'Имя не может быть пустым!'
            ];
        }

        if (empty($request->input('INN'))) {
            return [
                'status' => false,
                'message' => 'Токен не может быть пустым!'
            ];
        }

        return [
            'status' => true,
        ];
    }
}
