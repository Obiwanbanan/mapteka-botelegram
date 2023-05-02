<?php

namespace App\Telegram\Buttons;

use App\Models\Pharmacies;
use App\Telegram\Keyboard\TelegramKeyboard;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Telegram\Bot\Keyboard\Keyboard;

class TelegramButtons
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

    public function help(): void
    {
        $answer = 'Туториал как пользоваться ботом';
        $this->telegram->sendMessage(
            [
                'chat_id' => $this->chatId,
                'text' => $answer,
                'reply_markup' => TelegramKeyboard::menuHelp()
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
                $answer .= $listNumber . '. ' . $pharmacy->address . "<b><a href='$yandexMapUrl'> На карте 🌍 </a></b>" . "\n";;
            }
        } else {
            $answer = 'Нет данных';
        }


        $this->telegram->sendMessage(
            [
                'chat_id' => $this->chatId,
                'text' => $answer,
                'disable_web_page_preview' => true,
                'parse_mode' => 'HTML',
                'reply_markup' => TelegramKeyboard::mainMenu()
            ]
        );
    }

    public function search(
       object $updateDataTelegram
    ): void
    {
        try {
            $keyboard = Keyboard::make([
                'keyboard' => [
                    [
                        ['text' => '🔍 Поиск'],
                    ],
                ],
                'resize_keyboard' => true,
                'one_time_keyboard' => true,
                'input_field_placeholder' => 'Введите текст для поиска...',
            ]);
            $response = $this->telegram->sendMessage([
                'chat_id' => $this->chatId,
                'text' => 'Нажмите на кнопку "Поиск" для начала поиска',
                'reply_markup' => $keyboard,
            ]);

            $chat_id = $response->getChat()->getId();
            $message_id = $response->getMessageId();

                // Обрабатываем введенное значение
            if ($updateDataTelegram->getMessage()->getText() && $updateDataTelegram->getMessage()->getChat()->getId() == $chat_id) {
                $search_query = $updateDataTelegram->getMessage()->getText();

                // Отправляем обновленное сообщение с результатами поиска
                $this->telegram->editMessageText([
                    'chat_id' => $chat_id,
                    'message_id' => $message_id,
                    'text' => "Вы искали: $search_query",
                ]);
            }
        } catch (TelegramResponseException $e) {
            Log::error($e->getMessage());
        }

    }

    public function backMainMenu(): void
    {
        $answer = 'Выбирите действие';

        $this->telegram->sendMessage(
            [
                'chat_id' => $this->chatId,
                'text' => $answer,
                'disable_web_page_preview' => true,
                'parse_mode' => 'HTML',
                'reply_markup' => TelegramKeyboard::mainMenu()

            ]
        );
    }
}
