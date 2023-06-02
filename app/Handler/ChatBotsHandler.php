<?php

namespace App\Handler;

use App\Models\Bot;
use Telegram\Bot\Api;

class ChatBotsHandler
{
    public function add(
        object $request
    ): array {
        $validated = $this->validated($request);

        if (!$validated['status']) {
            return $validated;
        }

        try {
            $newBot = new Bot();
            $newBot->name = $request->input('name');
            $newBot->token = $request->input('token');
            $newBot->url = $request->input('url');
            $newBot->webhook = $this->setWebhook($request);
            $newBot->save();

            return [
                'status' => true,
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'что-то пошло не так!',
            ];
        }
    }

    public function update(
        object $request,
    ): array {
        $validated = $this->validated($request);

        if (!$validated['status']) {
            return $validated;
        }

        try {
            $id = $request->input('id');
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

            return [
                'status' => true,
                'message' => 'Чат бот успешно отредактирован',
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'что-то пошло не так!',
            ];
        }
    }

    public function remove(
        object $request
    ): array {
        try {
            $id = $request->input('id');
            Bot::where('id', $id)->delete();

            return [
                'status' => true,
                'message' => 'Бот успешно удалён!',
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'что-то пошло не так!',
            ];
        }
    }

    private function setWebhook(
        object $request
    ): bool {
        try {
            $url = $request->input('url');
            $botToken = $request->input('token');
            $telegram = new Api($botToken);
            return $telegram->setWebhook(['url' => $url . '/' . $botToken . '/' . 'webhook']);
        } catch (\Exception $exception) {
            return false;
        }
    }

    private function validated(object $request): array
    {
        if (empty($request->input('name'))) {
            return [
                'status' => false,
                'message' => 'Имя не может быть пустым!'
            ];
        }

        if (empty($request->input('token'))) {
            return [
                'status' => false,
                'message' => 'Токен не может быть пустым!'
            ];
        }

        if (empty($request->input('url'))) {
            return [
                'status' => false,
                'message' => 'Url вебхука не может быть пустым!'
            ];
        }

        return [
            'status' => true,
        ];
    }
}
