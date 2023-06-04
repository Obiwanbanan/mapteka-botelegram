<?php

namespace App\Handler\Organization;

use App\Helpers\TextHelper;
use App\Interface\DataRequestInterface;
use App\Models\Bot;
use App\Models\Organization;
use App\Models\Pharmacies;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class OrganizationHandler implements DataRequestInterface
{
    private ?string $action = null;
    private ?string $page = null;
    private ?string $organizationId = null;
    private ?string $organizationName = null;
    private ?string $organizationINN = null;
    private ?string $botId = null;
    private ?string $search = null;

    public function __invoke(
        Request $request,
    ): JsonResponse {
        $this->setUpDataRequest($request);

        match ($this->action) {
            TextHelper::ADD => $this->add(),
            TextHelper::UPDATE => $this->update(),
            TextHelper::REMOVE => $this->remove(),
            TextHelper::SEARCH => $organizations = $this->getOrganizationAfterSearch(),
        };

        return response()->json([
            'status' => true,
            'html' => view('ajax/' . $this->page, [
                $this->page => $this->page,
                'organizations' => $organizations ?? $this->getOrganizationWithBot(),
                'chatBots' => $this->getChatBots(),
            ])->render()
        ]);
    }

    public function setUpDataRequest(
        Request $request,
    ): void {
        $this->action = $request->input('action');
        $this->page = $request->input('page');
        $this->organizationId = $request->input('organizationId');
        $this->organizationName = $request->input('organizationName');
        $this->organizationINN = $request->input('organizationINN');
        $this->botId = $request->input('botId');
        $this->search = $request->input('search');
    }

    public function add(): void
    {
        $organization = new Organization();
        $organization->name = $this->organizationName;
        $organization->INN = $this->organizationINN;
        $organization->bot_id = $this->botId;
        $organization->save();
    }

    private function update(): void
    {
        Organization::where('id', $this->organizationId)
            ->update(
                [
                    'name' => $this->organizationName,
                    'INN' => $this->organizationINN,
                    'bot_id' => $this->botId,
                ]
            );
    }

    private function remove(): void
    {
        Pharmacies::where('organization_id', $this->organizationId)->delete();
        Organization::where('id', $this->organizationId)->delete();
    }

    private function getOrganizationAfterSearch(): Collection
    {
        return Organization::where(function ($query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('INN', 'LIKE', '%' . $this->search . '%');
        })
            ->with('bot')
            ->get();
    }

    private function getChatBots(): Collection
    {
        return Bot::all();
    }

    private function getOrganizationWithBot(): Collection
    {
        return Organization::with('bot')->get();
    }
}
