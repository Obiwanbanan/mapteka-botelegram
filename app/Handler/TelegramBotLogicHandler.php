<?php

namespace App\Handler;

use Telegram\Bot\Api;
use Telegram\Bot\Commands\HelpCommand;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotLogicHandler
{
    public function __invoke($request, $bot_token )
    {

        return $this->isChort($bot_token);
    }

    /**
     * @throws TelegramSDKException
     */
    private function isChort($bot_token)
    {
        $update = Telegram::commandsHandler(true);
        $telegram = new Api($bot_token);
        $lastMessage = $update->getMessage()->get('text');
        $lastIdMessage = $update->getChat()['id'];
        $telegram->addCommand(HelpCommand::class);
        if ($lastMessage == 'hello') {
            $telegram->sendMessage(
                [
                    'chat_id' => $lastIdMessage,
                    'text' => 'ne chort',
                    'reply_markup' => $this->replyMarkup()
                ]
            );
        } else {
            $telegram->sendMessage(
                [
                    'chat_id' => $lastIdMessage,
                    'text' => 'chort',
                    'reply_markup' => $this->replyMarkup()
                ]
            );
        }

        return (json_encode($update));
    }

    private function keyboard(): array
    {
        return [
            ['Поиск лекарств', 'Корзина'],
            ['Мои заказы', 'Адреса аптек'],
            ['Помощь']
        ];
    }

    private function replyMarkup(): Keyboard
    {
        return Keyboard::make([
            'keyboard' => $this->keyboard(),
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);
    }
}
