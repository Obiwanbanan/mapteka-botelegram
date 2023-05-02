<?php

namespace App\Handler;

use App\Telegram\Buttons\TelegramButtons;
use App\Telegram\Commands\HelpCommand;
use App\Telegram\Commands\StartCommand;
use App\Telegram\Keyboard\TelegramKeyboard;
use Illuminate\Http\Request;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Objects\Update;

class TelegramBotLogicHandler
{
    private ?string $botToken = null;
    public function __invoke(
        Request $request,
        string  $botToken,
    ): void
    {
        $this->botToken = $botToken;
        $this->registrationCommands();
        $this->handleButtons();
    }

    private function getUpdateDataTelegram(): array|Update
    {
        return Telegram::commandsHandler(true);
    }

    private function getTelegram(): Api {
        return new Api($this->botToken);
    }

    private function registrationCommands(): void
    {
        Telegram::addCommands(
            [
                (new StartCommand())->setTelegram($this->getTelegram()),
                (new HelpCommand())->setTelegram($this->getTelegram())
            ]
        );
    }

    private function handleButtons(): void
    {
        $updateDataTelegram = $this->getUpdateDataTelegram();

        if (!$updateDataTelegram->has('callback_query')) {
            return;
        }

        $callbackQuery = $updateDataTelegram->getCallbackQuery();
        $callbackData = $callbackQuery->getData();
        $chatId = $callbackQuery->message->chat->id;

        match ($callbackData) {
            TelegramKeyboard::HELP => (new TelegramButtons($this->getTelegram(), $chatId))->help(),
            TelegramKeyboard::ADDRESS => (new TelegramButtons($this->getTelegram(), $chatId))->address($this->botToken),
            TelegramKeyboard::BACK_MAIN_MENU => (new TelegramButtons($this->getTelegram(), $chatId))->backMainMenu(),
            TelegramKeyboard::SEARCH => (new TelegramButtons($this->getTelegram(), $chatId))->search($updateDataTelegram),

            TelegramKeyboard::CART => (new TelegramButtons($this->getTelegram(), $chatId))->help(),
            TelegramKeyboard::ORDERS => (new TelegramButtons($this->getTelegram(), $chatId))->help(),
        };

        $this->getTelegram()->answerCallbackQuery([
            'callback_query_id' => $callbackQuery->getId(),
        ]);
    }
}
