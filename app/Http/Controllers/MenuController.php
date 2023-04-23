<?php

namespace App\Http\Controllers;

use App\Handler\MenuHandler;
use App\Handler\OrganizationHandler;
use App\Handler\SettingsHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    public function menu(
        Request     $request,
        MenuHandler $handler
    ): JsonResponse
    {
        return $handler($request);
    }
}
