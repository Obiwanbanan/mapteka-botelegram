<?php

namespace App\Handler;

use App\Enums\Commands;
use App\Enums\SearchState;
use App\Models\ChatState;
use App\Telegram\Buttons\TelegramButtons;
use App\Telegram\Buttons\TelegramSearchHandler;
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
        $this->handleCommands();
        $this->handleSearchStatus();
        $this->handleButtons();
    }

    private function getTelegram(): Api
    {
        return new Api($this->botToken);
    }

    private function getUpdateDataTelegram(): array|Update
    {
        return $this->getTelegram()->getWebhookUpdate();
    }

    private function getChatId()
    {
        $update = json_decode(file_get_contents('php://input'), true);
        $update = new Update($update);

        return $update->getMessage()->getChat()->getId();
    }

    private function handleCommands(): void
    {
        $update = $this->getUpdateDataTelegram();
        if ($update->has('message') && $update->getMessage()->has('text')) {
            $messageText = $update->getMessage()->getText();
            if (str_starts_with($messageText, '/'))
                match ($messageText) {
                    Commands::START => (new StartCommand($this->getTelegram(), $this->getChatId()))->start(),
                    default => null
                };
        }
    }

    private function handleButtons(): void
    {
        $updateDataTelegram = $this->getUpdateDataTelegram();
        if (!$updateDataTelegram->has('callback_query')) {
            return;
        }

        $callbackQuery = $updateDataTelegram->getCallbackQuery();
        $callbackData = $callbackQuery->getData();

        match ($callbackData) {
            TelegramKeyboard::HELP => (new TelegramButtons($this->getTelegram(), $this->getChatId()))->help(),
            TelegramKeyboard::ADDRESS => (new TelegramButtons($this->getTelegram(), $this->getChatId()))->address($this->botToken),
            TelegramKeyboard::BACK_MAIN_MENU => (new TelegramButtons($this->getTelegram(), $this->getChatId()))->backMainMenu(),
            TelegramKeyboard::SEARCH => (new TelegramButtons($this->getTelegram(), $this->getChatId()))->search(),

            TelegramKeyboard::CART => (new TelegramButtons($this->getTelegram(), $this->getChatId()))->help(),
            TelegramKeyboard::ORDERS => (new TelegramButtons($this->getTelegram(), $this->getChatId()))->help(),
            default => null
        };

        $this->getTelegram()->answerCallbackQuery([
            'callback_query_id' => $callbackQuery->getId(),
        ]);
    }

    private function handleSearchStatus(): void
    {
        $chatState = ChatState::where('chat_id', $this->getChatId())->first();
        if (!$chatState) {
            return;
        }
        $state = $chatState->state;

        if (!$state) {
            return;
        }

        $updateDataTelegram = $this->getUpdateDataTelegram();

        match ($state) {
            SearchState::WAITING_FOR_CITY => (new TelegramSearchHandler($this->getTelegram(), $this->getChatId()))->searchCity($updateDataTelegram),
            default => null
        };
    }
}
