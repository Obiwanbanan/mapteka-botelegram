<?php

namespace App\Telegram\Buttons;

use App\Enums\AuxiliaryMessage;
use App\Models\ChatState;
use App\Models\Pharmacies;
use App\Enums\SearchState;
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
        Api    $telegram,
        string $chatId
    )
    {
        $this->telegram = $telegram;
        $this->chatId = $chatId;
    }

    public function help(): void
    {
        try {
            $this->telegram->sendMessage(
                [
                    'chat_id' => $this->chatId,
                    'text' => AuxiliaryMessage::HELP_MESSAGE,
                    'reply_markup' => TelegramKeyboard::menuHelp()
                ]
            );
        } catch (TelegramResponseException $e) {
            Log::error($e->getMessage());
        }
    }

    public function address(
        string $bot_token
    ): void
    {
        try {
            $pharmacies = Pharmacies::join('organizations', 'pharmacies.organization_id', '=', 'organizations.id')
                ->join('bots', 'organizations.bot_id', '=', 'bots.id')
                ->where('bots.token', $bot_token)
                ->select('pharmacies.address', 'pharmacies.map_url')
                ->get();

            $answer = '';
            if (!empty($pharmacies)) {
                foreach ($pharmacies as $key => $pharmacy) {
                    $listNumber = $key + 1;
                    $answer .= $listNumber . '. ' . $pharmacy->address . "<b><a href='$pharmacy->map_url'> На карте 🌍 </a></b>" . "\n";;
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
        } catch (TelegramResponseException $e) {
            Log::error($e->getMessage());
        }
    }

    public function search(): void
    {
        try {
            $this->telegram->sendMessage([
                'chat_id' => $this->chatId,
                'text' => 'Введите Ваш город',
            ]);

            ChatState::updateOrCreate(['chat_id' => $this->chatId], ['state' => SearchState::WAITING_FOR_CITY]);

        } catch (TelegramResponseException $e) {
            Log::error($e->getMessage());
        }

    }

    public function backMainMenu(): void
    {
        try {
            $this->telegram->sendMessage(
                [
                    'chat_id' => $this->chatId,
                    'text' => AuxiliaryMessage::CHOOSE_ACTION,
                    'disable_web_page_preview' => true,
                    'parse_mode' => 'HTML',
                    'reply_markup' => TelegramKeyboard::mainMenu()

                ]
            );
        } catch (TelegramResponseException $e) {
            Log::error($e->getMessage());
        }
    }

}
