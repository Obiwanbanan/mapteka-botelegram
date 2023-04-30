<?php

namespace App\Http\Controllers;

use App\Handler\TelegramBotLogicHandler;
use Illuminate\Http\Request;


class TelegramBotsController extends Controller
{

    public function TelegramBotLogic(
        Request         $request,
        TelegramBotLogicHandler $handler,
        $bot_token
    )
    {
        return $handler($request, $bot_token);
    }
}
