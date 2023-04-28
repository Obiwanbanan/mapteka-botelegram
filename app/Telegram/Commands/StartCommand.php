<?php

namespace App\Telegram\Commands;

use Illuminate\Support\Facades\Log;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Exceptions\TelegramResponseException;

class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'Start Command to get you started';

    public function handle()
    {
        $update = $this->getUpdate();
        $chatId = $update->getChat()['id'] ?? '';
        $telegram = $this->getTelegram();

        try {
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => 'Hello, world!'
            ]);
        } catch (TelegramResponseException $e) {
            Log::error($e->getMessage());
        }
    }
}
