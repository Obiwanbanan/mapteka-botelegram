<?php

namespace App\Handler;

use Illuminate\Http\JsonResponse;

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
