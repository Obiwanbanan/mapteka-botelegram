<?php

namespace App\Handler;

use App\Models\Bot;
use DefStudio\Telegraph\Models\TelegraphBot;
use DefStudio\Telegraph\Telegraph;
use Illuminate\Http\JsonResponse;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use mysql_xdevapi\Collection;
use Telegram\Bot\Api;
use DefStudio\Telegraph\Models\TelegraphChat;
use Telegram\Bot\Laravel\Facades\Telegram;

class SettingsHandler
{
    public function __invoke($request): JsonResponse
    {
        $page = $request->input('page');
        $action = $request->input('action') ?? '';
        $this->addBot($action, $request);
        return response()->json([
            'status' => true,
            'html' => view('ajax/' . $page, compact('page'))->render()
        ]);
    }

    private function addBot(
        string $action,
        object $request
    ): void
    {
        if ($action === 'add') {
            $newBot = new Bot();

            $newBot->name = $request->input('name');
            $newBot->username = $request->input('username');
            $newBot->token = $request->input('token');

            $newBot->save();
        }
    }

    private function sendMessage() {

        $telegram = new Api('6037349296:AAGChITqT8J8xfqBeOZk9K-sEXnUTMpNG9U');
//            $update = $telegram->getWebhookUpdate();
//            $chatId = $update->getMessage()->getChat()->getId();
        $telegram->sendMessage([
            'chat_id' => '725014793',
            'text' => 'Welcome to my bot!'
        ]);
    }
}
