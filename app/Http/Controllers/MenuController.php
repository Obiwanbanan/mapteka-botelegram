<?php

namespace App\Http\Controllers;

use App\Handler\MenuHandler;
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
