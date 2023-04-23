<?php

namespace App\Http\Controllers;

use App\Handler\ChatBotsHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ChatBotsController extends Controller
{

    public function chatBots(
        Request         $request,
        ChatBotsHandler $handler
    ): JsonResponse
    {
        return $handler($request);
    }
}
