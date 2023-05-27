<?php

namespace App\Telegram\Commands;

use App\Telegram\Keyboard\TelegramKeyboard;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramResponseException;

class StartCommand
{
    private ?Api $telegram = null;
    private ?string $chatId = null;

    public function __construct(
        Api $telegram,
        string $chatId
    )
    {
        $this->telegram = $telegram;
        $this->chatId = $chatId;
    }
    public function start(): void
    {
        try {
            $this->telegram->sendMessage([
                'chat_id' => $this->chatId,
                'text' => 'Привет',
                'reply_markup' => TelegramKeyboard::mainMenu()
            ]);
        } catch (TelegramResponseException $e) {
            Log::error($e->getMessage());
        }
    }
}
