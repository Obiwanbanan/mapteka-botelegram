<?php

namespace App\Handler;

use Telegram\Bot\Api;

class SetWebhookHandler
{
    public function __invoke($request): bool
    {
        $url = $request->input('url');
        $botToken = $request->input('token');
        $telegram = new Api($botToken);

        return $telegram->setWebhook(['url' => $url . '/' . 'webhook' ]);
    }
}
