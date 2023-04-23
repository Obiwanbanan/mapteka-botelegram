<?php

namespace App\Handler;

use App\Models\Bot;
use App\Models\Organization;
use Illuminate\Http\JsonResponse;

class MenuHandler
{
    public function __invoke(
       object $request
    ): JsonResponse
    {
        $page = $request->input('page');

        return match ($page) {
            "dashboard" => $this->dashboard($page),
            "organizations" => $this->organizations($page),
            "settings" => $this->settings($page),
            "chatbots" => $this->chatBots($page),
            default => $this->dashboard($page),
        };
    }


    private function dashboard(
        string $page
    ): JsonResponse
    {

        return response()->json([
            'status' => true,
            'html' => view('ajax/' . $page)->render(),
        ]);
    }

    private function organizations(
        string $page
    ): JsonResponse
    {
        $organizations = Organization::with('bot')->get();
        $chatBots = Bot::all();

        return response()->json([
            'status' => true,
            'html' => view('ajax/' . $page, compact('page', 'organizations', 'chatBots'))->render()
        ]);
    }

    private function chatBots(
        string $page
    ): JsonResponse
    {
        $chatBots = Bot::all();
        $choiceBot = null;
        return response()->json([
            'status' => true,
            'html' => view('ajax/' . $page, compact('page', 'chatBots', 'choiceBot'))->render()
        ]);
    }

    private function settings(
        string $page
    ): JsonResponse
    {
        return response()->json([
            'status' => true,
            'html' => view('ajax/' . $page, compact('page'))->render()
        ]);
    }


}
