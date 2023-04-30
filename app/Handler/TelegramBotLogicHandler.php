<?php

namespace App\Handler;

use App\Models\Bot;
use App\Telegram\Buttons\TelegramButtons;
use App\Telegram\Commands\HelpCommand;
use App\Telegram\Commands\StartCommand;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotLogicHandler
{
    /**
     * @throws TelegramSDKException
     */
    public function __invoke($request, $bot_token)
    {
        $update = Telegram::commandsHandler(true);
        $telegram = new Api($bot_token);
        $this->registrationCommand($telegram);
        $this->handleButtons($update, $telegram, $bot_token);
    }

    private function registrationCommand(
        object $telegram
    ): void
    {
        Telegram::addCommands(
            [
                (new StartCommand())->setTelegram($telegram),
                (new HelpCommand())->setTelegram($telegram)
            ]
        );
    }

    private function handleButtons(
        object $update,
        object $telegram,
        string $bot_token
    ): void
    {
        if ($update->has('callback_query')) {
            $callbackQuery = $update->getCallbackQuery();
            $callbackData = $callbackQuery->getData();
            $chatId = $callbackQuery->message->chat->id;

            match ($callbackData) {
                "help" => (new TelegramButtons($telegram, $chatId))->help(),
                "address" => (new TelegramButtons($telegram, $chatId))->address($bot_token),

                "search" => (new TelegramButtons($telegram, $chatId))->help(),
                "cart" => (new TelegramButtons($telegram, $chatId))->help(),
                "orders" => (new TelegramButtons($telegram, $chatId))->help(),
            };

            $telegram->answerCallbackQuery([
                'callback_query_id' => $callbackQuery->getId(),
            ]);
        }
    }
}
