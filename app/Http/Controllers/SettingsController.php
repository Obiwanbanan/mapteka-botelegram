<?php

namespace App\Http\Controllers;

use App\Handler\SettingsHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class SettingsController extends Controller
{

    public function settings(
        Request         $request,
        SettingsHandler $handler
    ): JsonResponse
    {
        return $handler($request);
    }
}
