<?php

namespace App\Http\Controllers;

use App\Handler\ChatBotsHandler;
use App\Models\Bot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Telegram\Bot\Api;


class ChatBotsController extends Controller
{
public function index(): string
{
    $bots = Bot::all();

    return view('chatBots/index', [
        'chatBots' => $bots,
        'choiceBot' => $bots[0] ?? null,
    ]);
}

    public function chatBots(
        Request         $request,
        ChatBotsHandler $handler
    ): JsonResponse
    {
        return $handler($request);
    }
}
