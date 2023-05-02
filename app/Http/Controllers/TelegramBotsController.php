<?php

namespace App\Http\Controllers;

use App\Handler\TelegramBotLogicHandler;
use Illuminate\Http\Request;

class TelegramBotsController extends Controller
{
    public function TelegramBotLogic(
        Request                 $request,
        TelegramBotLogicHandler $handler,
        string                  $bot_token
    ): void
    {
        $handler($request, $bot_token);
    }
}
