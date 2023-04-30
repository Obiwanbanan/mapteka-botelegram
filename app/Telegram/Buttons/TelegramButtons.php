<?php

namespace App\Telegram\Buttons;

class TelegramButtons
{
    private object $telegram;
    private string $chatId;

    public function __construct($telegram, $chatId)
    {
        $this->telegram = $telegram;
        $this->chatId = $chatId;
    }

    public function help(): void
    {

        $this->telegram->sendMessage(
                [
                    'chat_id' => $this->chatId,
                    'text' => 'help',
                ]
            );

    }

    public function address(): void
    {
        $this->telegram->sendMessage(
            [
                'chat_id' => $this->chatId,
                'text' => 'address',
            ]
        );
    }
}
