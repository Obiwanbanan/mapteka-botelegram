<?php

namespace App\Handler;

use App\Models\Bot;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Telegram\Bot\Api;

class SettingsHandler
{
    public function __invoke($request): JsonResponse
    {
        $page = $request->input('page');

        return response()->json([
            'status' => true,
            'html' => view('ajax/' . $page)->render(),
        ]);
    }
}
