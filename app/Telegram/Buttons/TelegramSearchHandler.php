<?php

namespace App\Telegram\Buttons;

use App\Models\ChatState;
use App\Telegram\Keyboard\TelegramKeyboard;
use Telegram\Bot\Api;

class TelegramSearchHandler
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


    public function searchCity(): void
    {
        $this->telegram->sendMessage([
            'text' => print_r('test', true), // Выводим результаты в виде строки
            'chat_id' => $this->chatId,
            'reply_markup' => TelegramKeyboard::menuSearchCity()
        ]);

        $this->stateReset();
    }

    private function stateReset(): void
    {
        $chatId = ChatState::where('chat_id', $this->chatId)->first();
        if (!$chatId) {
            return;
        }

        $chatId->update(['state' => null]);
    }

}
