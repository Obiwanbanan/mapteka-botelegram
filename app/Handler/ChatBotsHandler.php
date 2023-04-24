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

            $status = $this->setWebhook($request);
            $newBot = new Bot();

            $newBot->name = $request->input('name');
            $newBot->token = $request->input('token');
            $newBot->webhook = $status;

            $newBot->save();
        }
    }

    private function update(
        string $action,
        object $request,
    ): void
    {
        if ($action === 'update') {
            $id = $request->input('botId');
            $status = $this->setWebhook($request);

            Bot::where('id', $id)
                ->update(
                    [
                        'name' => $request->input('name'),
                        'token' => $request->input('token'),
                        'webhook' => $status,
                        'url' => $request->input('url'),
                    ]
                );
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

    private function setWebhook(
        object $request
    ): bool
    {
        try {
            $url = $request->input('url');
            $botToken = $request->input('token');
            $telegram = new Api($botToken);
            return $telegram->setWebhook(['url' => $url . '/' . 'webhook']);
        } catch (\Exception $exception) {

            return false;
        }
    }
}
