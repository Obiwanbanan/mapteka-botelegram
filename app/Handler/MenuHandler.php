<?php

namespace App\Handler;

use App\Models\Bot;
use App\Models\Organization;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Telegram\Bot\Api;

class MenuHandler
{
    public function __invoke(
       object $request
    ): JsonResponse
    {
        $page = $request->input('page');

        if ($page === 'dashboard') {
            $content = $this->dashboard($page);
        }

        if ($page === 'organizations') {
            $content = $this->organizations($page);
        }

        if ($page === 'settings') {
            $content = $this->settings($page);
        }

        if ($page === 'chatbots') {
            $content = $this->chatBots($page);
        }


        return $content;
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
        return response()->json([
            'status' => true,
            'html' => view('ajax/' . $page, compact('page', 'organizations'))->render()
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
