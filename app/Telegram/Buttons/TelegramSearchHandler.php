<?php

namespace App\Telegram\Buttons;

use App\Enums\ErrorMessage;
use App\Enums\AuxiliaryMessage;
use App\Models\ChatState;
use App\Models\City;
use App\Telegram\Keyboard\TelegramKeyboard;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramResponseException;

class TelegramSearchHandler
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


    public function searchCity(
        object $updateDataTelegram
    ): void
    {
        try {

            $searchQuery = $updateDataTelegram->getMessage()->getText();

            if (strlen($searchQuery) < 3) {
                $this->telegram->sendMessage([
                    'text' => ErrorMessage::SHORT_STRING,
                    'chat_id' => $this->chatId,
                ]);


                return;
            }

            if (!preg_match('/^[а-яА-ЯёЁ]+$/u', $searchQuery)) {
                $this->telegram->sendMessage([
                    'text' => ErrorMessage::ONLY_STRING,
                    'chat_id' => $this->chatId,
                ]);


                return;
            }

            $cities = City::where('name', 'LIKE', '%' . $searchQuery . '%')->pluck('name');

            if ($cities->isEmpty()) {
                $this->telegram->sendMessage([
                    'text' => ErrorMessage::EMPTY,
                    'chat_id' => $this->chatId,
                ]);


                return;
            }

            $this->telegram->sendMessage([
                'text' => AuxiliaryMessage::SELECT_CITY,
                'chat_id' => $this->chatId,
                'reply_markup' => TelegramKeyboard::menuSearchResult($cities)
            ]);

            $this->stateReset();


        } catch (TelegramResponseException $e) {
            Log::error($e->getMessage());
        }
    }

    private function stateReset(): void
    {
        try {
            $chatId = ChatState::where('chat_id', $this->chatId)->first();
            if (!$chatId) {
                return;
            }

            $chatId->update(['state' => null]);

        } catch (TelegramResponseException $e) {
            Log::error($e->getMessage());
        }
    }

}
