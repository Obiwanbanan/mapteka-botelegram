<?php

namespace App\Handler;

use App\Models\Bot;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Telegram\Bot\Api;

class ChatBotsHandler
{
    public function __invoke($request): JsonResponse
    {
        $action = $request->input('action') ?? '';
        $page = $request->input('page');

        $this->add($action, $request);
        $this->update($action, $request);
        $this->remove($action, $request);

        $choiceBot = $this->choiceBot($action, $request);
        $chatBots = $this->getAllBots();

        return response()->json([
            'status' => true,
            'html' => view('ajax/' . $page, compact('chatBots', 'choiceBot'))->render(),
        ]);
    }

    private function add(
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

    private function remove(
        string $action,
        object $request
    ): void
    {
        if ($action === 'remove') {
            $id = $request->input('botId');
            Bot::where('id', $id)->delete();

        }
    }

    private function sendMessage()
    {

        $telegram = new Api('6037349296:AAGChITqT8J8xfqBeOZk9K-sEXnUTMpNG9U');
//            $update = $telegram->getWebhookUpdate();
//            $chatId = $update->getMessage()->getChat()->getId();
        $telegram->sendMessage([
            'chat_id' => '725014793',
            'text' => 'Welcome to my bot!'
        ]);
    }

    private function getAllBots(): Collection
    {
        return Bot::all();
    }

    private function choiceBot(
        string $action,
        object $request
    ): object|null
    {
        if ($action === 'choice') {
            $botId = $request->input('botId');
            return Bot::where('id', $botId)->get()->first();
        }

        return null;
    }

    private function update(
        string $action,
        object $request,
    ): void
    {
        if ($action === 'update') {
            $id = $request->input('botId');
            Bot::where('id', $id)
                ->update(
                    [
                        'name' => $request->input('name'),
                        'token' => $request->input('token'),
                    ]
                );
        }
    }
}
