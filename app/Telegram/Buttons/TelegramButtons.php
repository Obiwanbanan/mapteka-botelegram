<?php

namespace App\Telegram\Buttons;

use App\Models\Bot;
use App\Models\Organization;
use App\Models\Pharmacies;

class TelegramButtons
{
    private object $telegram;
    private string $chatId;

    public function __construct(
        object $telegram,
        string $chatId
    )
    {
        $this->telegram = $telegram;
        $this->chatId = $chatId;
    }

    public function help(): void
    {
        $answer = 'Туториал как пользоваться ботом';
        $this->telegram->sendMessage(
            [
                'chat_id' => $this->chatId,
                'text' => $answer,
            ]
        );

    }

    public function address(
        string $bot_token
    ): void
    {
        $botId = Bot::where('token', $bot_token)->value('id');
        $organizationId = Organization::where('bot_id', $botId)->value('id');
        $pharmacies = Pharmacies::where('organization_id', $organizationId)
            ->get(['address', 'latitude', 'longitude']);

        $zoom = 16;
        $answer = '';

        foreach ($pharmacies as $key => $pharmacy) {
            $yandexMapUrl = "https://yandex.ru/maps/?ll={$pharmacy->longitude},{$pharmacy->latitude}&z={$zoom}&mode=search&text={$pharmacy->latitude},{$pharmacy->longitude}";
            $listNumber = $key + 1;
            $answer .= "<b><a href='$yandexMapUrl'> $listNumber. $pharmacy->address </a></b>" . "\n";;
        }


        $this->telegram->sendMessage(
            [
                'chat_id' => $this->chatId,
                'text' => $answer,
                'disable_web_page_preview' => true,
                'parse_mode' => 'HTML',
            ]
        );
    }


}
