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
        $pharmacies = Pharmacies::join('organizations', 'pharmacies.organization_id', '=', 'organizations.id')
            ->join('bots', 'organizations.bot_id', '=', 'bots.id')
            ->where('bots.token', $bot_token)
            ->select('pharmacies.address', 'pharmacies.latitude', 'pharmacies.longitude')
            ->get();

        $zoom = 16;
        $answer = '';
        if (!empty($pharmacies)) {
            foreach ($pharmacies as $key => $pharmacy) {
                $yandexMapUrl = "https://yandex.ru/maps/?ll={$pharmacy->longitude},{$pharmacy->latitude}&z={$zoom}&mode=search&text={$pharmacy->latitude},{$pharmacy->longitude}";
                $listNumber = $key + 1;
                $answer .= $listNumber .'. '. $pharmacy->address . "<b><a href='$yandexMapUrl'> На карте 🌍 </a></b>" . "\n";;
            }
        } else {
            $answer = 'Нет данных';
        }


        $this->telegram->sendMessage(
            [
                'chat_id' => $this->chatId,
                'text' => $answer ,
                'disable_web_page_preview' => true,
                'parse_mode' => 'HTML',
            ]
        );
    }

    public function search(): void
    {
        var_dump('search');
    }
}
