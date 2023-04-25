<?php

namespace App\Http\Controllers;

use App\Handler\ChatBotsHandler;
use App\Handler\SetWebhookHandler;
use App\Handler\TelegramBotLogicHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class TelegramBotsController extends Controller
{

    public function TelegramBotLogic(
        Request         $request,
        TelegramBotLogicHandler $handler,
        $bot_token
    ): bool|string
    {
        return $handler($request, $bot_token);
    }
}
